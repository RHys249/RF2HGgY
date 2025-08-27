<?php
// 代码生成时间: 2025-08-27 11:57:53
// 引入Yii框架核心组件
require_once("vendor/autoload.php");

use Yii;
use yii\db\{ActiveRecord, Exception};

/**
 * ShoppingCart AR class
 *
 * @property int $id
 * @property array $items
 */
class ShoppingCart extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static function tableName()
    {
        return 'shopping_cart';
    }

    /**
     * 获取购物车中的项目
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(CartItem::class, ["cart_id" => "id"]);
    }

    /**
     * 添加商品到购物车
     *
     * @param int $productId
     * @param int $quantity
     * @return boolean
     */
    public function addItem($productId, $quantity)
    {
        if (!$this->loadCart()) {
            return false;
        }

        if (!isset($this->items[$productId])) {
            $this->items[$productId] = ['quantity' => 0, 'productId' => $productId];
        }

        $this->items[$productId]['quantity'] += $quantity;
        return $this->saveCart();
    }

    /**
     * 从购物车中移除商品
     *
     * @param int $productId
     * @return boolean
     */
    public function removeItem($productId)
    {
        if (!$this->loadCart()) {
            return false;
        }

        if (isset($this->items[$productId])) {
            unset($this->items[$productId]);
            return $this->saveCart();
        }

        return false;
    }

    /**
     * 加载购物车数据
     *
     * @return boolean
     */
    private function loadCart()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

        $this->items = $session->get("cart") ?: [];
        return true;
    }

    /**
     * 保存购物车数据
     *
     * @return boolean
     */
    private function saveCart()
    {
        $session = Yii::$app->session;
        $session->set("cart", $this->items);
        return true;
    }
}

/**
 * CartItem AR class
 *
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $quantity
 */
class CartItem extends ActiveRecord
{
    public static function tableName()
    {
        return 'cart_items';
    }

    /**
     * 获取购物车
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(ShoppingCart::class, ["id" => "cart_id"]);
    }
}

// 使用示例
try {
    $cart = new ShoppingCart();
    $cart->addItem(1, 2); // 添加商品ID为1的商品2个到购物车
    echo "Item added to cart";
} catch (Exception $e) {
    Yii::error($e->getMessage());
    echo "Error adding item to cart";
}

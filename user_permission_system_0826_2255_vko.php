<?php
// 代码生成时间: 2025-08-26 22:55:37
// 用户权限管理系统
// 使用YII框架开发

class UserPermissionSystem {

    // 用户权限数据存储
    private $permissions = [];
    
    // 构造函数
    public function __construct() {
        // 初始化权限数据
        $this->initPermissions();
    }
    
    // 初始化权限数据
    private function initPermissions() {
        // 这里可以根据实际情况从数据库或配置文件加载权限数据
        $this->permissions = [
            'admin' => ['create', 'read', 'update', 'delete'],
            'editor' => ['read', 'update'],
            'viewer' => ['read']
        ];
    }
    
    // 检查用户是否有指定权限
    public function hasPermission($role, $permission) {
        // 检查角色是否存在
        if (!array_key_exists($role, $this->permissions)) {
            // 角色不存在，返回false
            return false;
        }
        
        // 检查权限是否存在于角色中
        return in_array($permission, $this->permissions[$role]);
    }
    
    // 添加新的角色权限
    public function addPermission($role, $permission) {
        // 检查角色是否存在
        if (!array_key_exists($role, $this->permissions)) {
            // 角色不存在，返回false
            return false;
        }
        
        // 添加权限到角色
        $this->permissions[$role][] = $permission;
        return true;
    }
    
    // 删除角色权限
    public function removePermission($role, $permission) {
        // 检查角色是否存在
        if (!array_key_exists($role, $this->permissions)) {
            // 角色不存在，返回false
            return false;
        }
        
        // 删除权限从角色
        $index = array_search($permission, $this->permissions[$role]);
        if ($index !== false) {
            unset($this->permissions[$role][$index]);
            return true;
        }
        return false;
    }
    
    // 获取角色的所有权限
    public function getPermissions($role) {
        // 检查角色是否存在
        if (!array_key_exists($role, $this->permissions)) {
            // 角色不存在，返回空数组
            return [];
        }
        
        // 返回角色权限
        return $this->permissions[$role];
    }
    
}

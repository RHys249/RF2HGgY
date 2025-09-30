<?php
// 代码生成时间: 2025-09-30 21:59:20
// GraphTheoryAlgorithm.php
// 提供图论算法的基本实现

class GraphTheoryAlgorithm {

    // 定义图的数据结构
    private $graph;

    // 构造函数，初始化图
    public function __construct() {
        $this->graph = [];
    }

    // 添加边
    public function addEdge($from, $to) {
        if (!isset($this->graph[$from])) {
            $this->graph[$from] = [];
        }
        $this->graph[$from][] = $to;
    }

    // 深度优先搜索（DFS）
    public function dfs($start_vertex) {
        $visited = [];
        $this->dfsVisit($start_vertex, $visited);
    }

    private function dfsVisit($vertex, &$visited) {
        // Mark the vertex as visited
        $visited[$vertex] = true;
        echo "Visited $vertex
";

        // Recur for all the vertices adjacent to this vertex
        if (isset($this->graph[$vertex])) {
            foreach ($this->graph[$vertex] as $adjacent) {
                if (!isset($visited[$adjacent])) {
                    $this->dfsVisit($adjacent, $visited);
                }
            }
        }
    }

    // 广度优先搜索（BFS）
    public function bfs($start_vertex) {
        $visited = [];
        $queue = [];
        $queue[] = $start_vertex;
        $visited[$start_vertex] = true;

        while (!empty($queue)) {
            $vertex = array_shift($queue);
            echo "Visited $vertex
";

            if (isset($this->graph[$vertex])) {
                foreach ($this->graph[$vertex] as $adjacent) {
                    if (!isset($visited[$adjacent])) {
                        $queue[] = $adjacent;
                        $visited[$adjacent] = true;
                    }
                }
            }
        }
    }

    // 检测图中是否存在环
    public function hasCycle() {
        $visited = [];
        $recStack = [];

        foreach ($this->graph as $vertex => &neighbors) {
            if (!isset($visited[$vertex])) {
                if ($this->isCyclicUtil($vertex, $visited, $recStack)) {
                    return true;
                }
            }
        }
        return false;
    }

    private function isCyclicUtil($vertex, &$visited, &$recStack) {
        if (isset($recStack[$vertex])) {
            return true;
        }

        if (isset($visited[$vertex])) {
            return false;
        }

        $visited[$vertex] = true;
        $recStack[$vertex] = true;

        if (isset($this->graph[$vertex])) {
            foreach ($this->graph[$vertex] as $neighbor) {
                if ($this->isCyclicUtil($neighbor, $visited, $recStack)) {
                    return true;
                }
            }
        }

        $recStack[$vertex] = false;
        return false;
    }

}

// 使用示例
$algorithm = new GraphTheoryAlgorithm();
$algorithm->addEdge(0, 1);
$algorithm->addEdge(1, 2);
$algorithm->addEdge(2, 0); // 添加一个环来测试检测环功能
$algorithm->dfs(0);
echo "
";
$algorithm->bfs(0);
echo "
";
$hasCycle = $algorithm->hasCycle();
echo "Graph has a cycle: " . ($hasCycle ? 'Yes' : 'No') . "
";

?>
<?php
// 代码生成时间: 2025-10-01 18:38:58
class ReinforcementLearningEnvironment extends \yiiase\Component {

    /* @var callable $actionFunction This is the user-defined function to select actions. */
    public $actionFunction;

    /* @var callable $rewardFunction This is the user-defined function to calculate rewards. */
    public $rewardFunction;

    /* @var callable $stateTransitionFunction This is the user-defined function to determine state transitions. */
    public $stateTransitionFunction;

    /* @var array $currentState Holds the current state of the environment. */
    private $currentState = [];

    /* @var array $actionsList List of possible actions the agent can take. */
    private $actionsList = [];

    /*
     * Initializes the environment by setting up the state, actions, and user-defined functions.
     *
     * @param array $initialState The initial state of the environment.
     * @param array $actions The list of possible actions.
     * @param callable $actionFunction The function to select actions.
     * @param callable $rewardFunction The function to calculate rewards.
     * @param callable $stateTransitionFunction The function to determine state transitions.
     */
    public function __construct($initialState, $actions, $actionFunction, $rewardFunction, $stateTransitionFunction) {
        $this->currentState = $initialState;
        $this->actionsList = $actions;
        $this->actionFunction = $actionFunction;
        $this->rewardFunction = $rewardFunction;
        $this->stateTransitionFunction = $stateTransitionFunction;
    }

    /*
     * Selects an action based on the current state and the user-defined action function.
     *
     * @return mixed The action selected by the action function.
     */
    public function selectAction() {
        if (is_callable($this->actionFunction)) {
            return call_user_func($this->actionFunction, $this->currentState);
        } else {
            throw new \yiiase\InvalidConfigException('Action function must be callable.');
        }
    }

    /*
     * Calculates the reward based on the current state and the selected action using the user-defined reward function.
     *
     * @param mixed $action The action taken by the agent.
     * @return float The reward calculated by the reward function.
     */
    public function calculateReward($action) {
        if (is_callable($this->rewardFunction)) {
            return call_user_func($this->rewardFunction, $this->currentState, $action);
        } else {
            throw new \yiiase\InvalidConfigException('Reward function must be callable.');
        }
    }

    /*
     * Updates the state of the environment based on the current state and the selected action using the user-defined state transition function.
     *
     * @param mixed $action The action taken by the agent.     * @return array The new state of the environment.
     */
    public function updateState($action) {
        if (is_callable($this->stateTransitionFunction)) {
            $this->currentState = call_user_func($this->stateTransitionFunction, $this->currentState, $action);
            return $this->currentState;
        } else {
            throw new \yiiase\InvalidConfigException('State transition function must be callable.');
        }
    }

    /*
     * Resets the environment to its initial state.
     *
     * @return array The initial state of the environment.
     */
    public function reset() {
        return $this->currentState = [];
    }

    /*
     * Returns the current state of the environment.
     *
     * @return array The current state.
     */
    public function getCurrentState() {
        return $this->currentState;
    }
}

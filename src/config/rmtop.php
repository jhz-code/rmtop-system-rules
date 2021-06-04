<?php

return [
    /*
     *Default Tauthz enforcer
     */
    'default' => 'rm',

    'log' => [
        // changes whether Lauthz will log messages to the Logger.
        'enabled' => false,
        // Casbin Logger, Supported: \Psr\Log\LoggerInterface|string
        'logger' => 'log',
    ],


    'rm' => [
        /*
           * 数据库设置.
           */
        'database' => [
            // 数据库连接名称，不填为默认配置.
            'connection' => '',
            // 策略表名（不含表前缀）
            'sys_rule_name' => 'sys_rule',
            'sys_role_name' => 'sys_role',
            // 策略表完整名称.
            'rules_table' => null,
        ],
    ],
];


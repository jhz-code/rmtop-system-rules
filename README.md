# rmtop-rmsf-system-rules
自动创建系统权限

#安装

composer require  rmtop/rmsf-system-rules


###发布文件：
php think rmtop:sys_publish


###数据迁移：
php think migrate:run


###扫描系统：
php think rmtop:sys_make admin/controller admin
# rmtop-rmsf-system-rules
自动创建系统权限

#安装

`composer require  rmtop/rmsf-system-rules
`

###发布文件：
`php think rmtop:sys_publish
`
发布系统权限相关文件


###数据迁移：
`php think migrate:run
`
创建权限相关数据表
rm_sys_role  //角色表  <br>
rm_sys_rule  //规则表  <br>
rm_rules     //权限角色关系表 <br>



###扫描系统：
执行示例：<br>
`php think rmtop:sys_make admin/controller admin`
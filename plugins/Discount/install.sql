DROP TABLE IF EXISTS `shua_plugin_discount_tools`;
CREATE TABLE `shua_plugin_discount_tools`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '主键',
  `tid` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品ID',
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '数据内容',
  `createTime` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updateTime` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tid`(`tid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `auth_assignment`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_item_child`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `auth_rule`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- -------------------------------------------
-- TABLE `cardapio`
-- -------------------------------------------
DROP TABLE IF EXISTS `cardapio`;
CREATE TABLE IF NOT EXISTS `cardapio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(20) DEFAULT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `categoria`
-- -------------------------------------------
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `estoque`
-- -------------------------------------------
DROP TABLE IF EXISTS `estoque`;
CREATE TABLE IF NOT EXISTS `estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor` varchar(50) NOT NULL,
  `produto` varchar(45) NOT NULL,
  `qtde` int(11) NOT NULL,
  `qtdeestoque` int(11) DEFAULT NULL,
  `tipolanc` varchar(10) NOT NULL,
  `data` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `fornecedor`
-- -------------------------------------------
DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` int(6) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `isAtivo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `migration`
-- -------------------------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `noticias`
-- -------------------------------------------
DROP TABLE IF EXISTS `noticias`;
CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `conteudo` text NOT NULL,
  `data` date DEFAULT NULL,
  `imageFile` blob,
  `isAtivo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `prato`
-- -------------------------------------------
DROP TABLE IF EXISTS `prato`;
CREATE TABLE IF NOT EXISTS `prato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `prato_cardapio`
-- -------------------------------------------
DROP TABLE IF EXISTS `prato_cardapio`;
CREATE TABLE IF NOT EXISTS `prato_cardapio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prato_id` int(11) DEFAULT NULL,
  `cardapio_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prato_id` (`prato_id`),
  KEY `cardapio_id` (`cardapio_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `produto`
-- -------------------------------------------
DROP TABLE IF EXISTS `produto`;
CREATE TABLE IF NOT EXISTS `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `unidade_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `unidade_id` (`unidade_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `produto_prato`
-- -------------------------------------------
DROP TABLE IF EXISTS `produto_prato`;
CREATE TABLE IF NOT EXISTS `produto_prato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prato_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prato_id` (`prato_id`),
  KEY `produto_id` (`produto_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `refeicao`
-- -------------------------------------------
DROP TABLE IF EXISTS `refeicao`;
CREATE TABLE IF NOT EXISTS `refeicao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `sugestoes`
-- -------------------------------------------
DROP TABLE IF EXISTS `sugestoes`;
CREATE TABLE IF NOT EXISTS `sugestoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `verifyCode` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `unidade`
-- -------------------------------------------
DROP TABLE IF EXISTS `unidade`;
CREATE TABLE IF NOT EXISTS `unidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE `usuarios`
-- -------------------------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(13) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `rua` varchar(50) DEFAULT NULL,
  `numero` int(6) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(30) DEFAULT NULL,
  `role` varchar(30) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `isAtivo` tinyint(1) NOT NULL DEFAULT '0',
  `codVerificacao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- -------------------------------------------
-- TABLE DATA auth_assignment
-- -------------------------------------------
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('admin','4','1527820241');
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('discente','2','1527820077');
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('nutricionista','3','1527820220');



-- -------------------------------------------
-- TABLE DATA auth_item
-- -------------------------------------------
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('addPost','2','Add a post','','','1527819967','1527819967');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('admin','1','','userGroup','','1527819968','1527819968');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('deletePost','2','Delete a post','','','1527819967','1527819967');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('discente','1','','userGroup','','1527819968','1527819968');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('editPost','2','Edit a post','','','1527819967','1527819967');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('indexPost','2','Index a post','','','1527819967','1527819967');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('nutricionista','1','','userGroup','','1527819968','1527819968');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('viewPost','2','View a post','','','1527819967','1527819967');



-- -------------------------------------------
-- TABLE DATA auth_item_child
-- -------------------------------------------
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','addPost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('discente','addPost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('nutricionista','addPost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','deletePost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('nutricionista','deletePost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','editPost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('nutricionista','editPost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','indexPost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('admin','viewPost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('discente','viewPost');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('nutricionista','viewPost');



-- -------------------------------------------
-- TABLE DATA auth_rule
-- -------------------------------------------
INSERT INTO `auth_rule` (`name`,`data`,`created_at`,`updated_at`) VALUES
('userGroup','O:22:\"app\\rbac\\UserGroupRule\":3:{s:4:\"name\";s:9:\"userGroup\";s:9:\"createdAt\";i:1527819967;s:9:\"updatedAt\";i:1527819967;}','1527819967','1527819967');



-- -------------------------------------------
-- TABLE DATA cardapio
-- -------------------------------------------
INSERT INTO `cardapio` (`id`,`categoria`,`data`) VALUES
('8','Almoço','2018-05-09');
INSERT INTO `cardapio` (`id`,`categoria`,`data`) VALUES
('9','Almoço','2018-06-06');
INSERT INTO `cardapio` (`id`,`categoria`,`data`) VALUES
('10','Almoço','2018-06-01');
INSERT INTO `cardapio` (`id`,`categoria`,`data`) VALUES
('11','Janta','2018-06-06');



-- -------------------------------------------
-- TABLE DATA categoria
-- -------------------------------------------
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('8','Frios');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('2','Carnes');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('7','Laticínios');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('6','Grãos');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('11','Cereais');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('12','Hortaliças');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('13','Codimentos e temperos');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('14','Verduras');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('15','Legumes');
INSERT INTO `categoria` (`id`,`descricao`) VALUES
('16','Frutas');



-- -------------------------------------------
-- TABLE DATA estoque
-- -------------------------------------------
INSERT INTO `estoque` (`id`,`fornecedor`,`produto`,`qtde`,`qtdeestoque`,`tipolanc`,`data`) VALUES
('83','Caribé','Arroz','30','','Entrada','2018-04-19');
INSERT INTO `estoque` (`id`,`fornecedor`,`produto`,`qtde`,`qtdeestoque`,`tipolanc`,`data`) VALUES
('82','Caribé','Arroz','30','','Entrada','2018-04-19');



-- -------------------------------------------
-- TABLE DATA fornecedor
-- -------------------------------------------
INSERT INTO `fornecedor` (`id`,`nome`,`email`,`telefone`,`cnpj`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`isAtivo`) VALUES
('1','Caribé','caribe@gmail.com','(87)98638-2672','43.567.890/8765-43','Rua Central','54','','Centro','Januária','Minas Gerais','1');
INSERT INTO `fornecedor` (`id`,`nome`,`email`,`telefone`,`cnpj`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`isAtivo`) VALUES
('2','Center Frios ltda','center.frios@gmail.com','(56)46534-5324','43.677.899/6535-43','Rua do sertanejo','876','Loja','Centro','Januária','Minas Gerais','1');
INSERT INTO `fornecedor` (`id`,`nome`,`email`,`telefone`,`cnpj`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`isAtivo`) VALUES
('3','Pão de Mel','paodemel@gmail.com','(92)39817-3655','09.893.724/4444-44','Av. Conego Ramiro Leite','730','Loja','Centro','Januária','Minas Gerais','1');
INSERT INTO `fornecedor` (`id`,`nome`,`email`,`telefone`,`cnpj`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`isAtivo`) VALUES
('4','teste','teste@gmail.com','(98)49757-8436','08.973.456/2744-44','Rua C','32','','Centro','teste','Minas Gerais','0');
INSERT INTO `fornecedor` (`id`,`nome`,`email`,`telefone`,`cnpj`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`isAtivo`) VALUES
('5','gkjkhsdgvv','djf@gmail.com','(98)74637-2222','08.437.576/4753-74','a','43','','cs','cddf','Paraná','0');



-- -------------------------------------------
-- TABLE DATA noticias
-- -------------------------------------------
INSERT INTO `noticias` (`id`,`titulo`,`conteudo`,`data`,`imageFile`,`isAtivo`) VALUES
('3','hjgjhsda','jkghjgvjhgdjf hkjahkjdshgkj','2018-04-03','~sVw5900.jpg','0');
INSERT INTO `noticias` (`id`,`titulo`,`conteudo`,`data`,`imageFile`,`isAtivo`) VALUES
('4','jhgjgjhcv','dffvsdfgvdf','2018-04-03','~sVw5900.jpg','0');
INSERT INTO `noticias` (`id`,`titulo`,`conteudo`,`data`,`imageFile`,`isAtivo`) VALUES
('15','Agora vai','Deu certo pae','2018-04-11','Foto0077.jpg','1');
INSERT INTO `noticias` (`id`,`titulo`,`conteudo`,`data`,`imageFile`,`isAtivo`) VALUES
('27','iiiiiiiiiiiiiiiiiiiiiiiii','jhgdhfjjjjjjjjjjjgsdah','2018-04-11','~sVw5900.jpg','0');
INSERT INTO `noticias` (`id`,`titulo`,`conteudo`,`data`,`imageFile`,`isAtivo`) VALUES
('23','mjhgbxcvm','jhgdhfjjjjjjjjjjjgsdah','2018-04-11','~sVw5900.jpg','1');



-- -------------------------------------------
-- TABLE DATA prato
-- -------------------------------------------
INSERT INTO `prato` (`id`,`descricao`) VALUES
('1','Feijão tropeiro');
INSERT INTO `prato` (`id`,`descricao`) VALUES
('2','Arroz');
INSERT INTO `prato` (`id`,`descricao`) VALUES
('3','Frango frito');
INSERT INTO `prato` (`id`,`descricao`) VALUES
('4','Salada');
INSERT INTO `prato` (`id`,`descricao`) VALUES
('5','Bife');
INSERT INTO `prato` (`id`,`descricao`) VALUES
('6','testeprato');
INSERT INTO `prato` (`id`,`descricao`) VALUES
('7','Carne');



-- -------------------------------------------
-- TABLE DATA prato_cardapio
-- -------------------------------------------
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('6','2','8');
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('7','1','8');
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('8','4','8');
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('9','1','9');
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('10','2','9');
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('11','3','9');
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('12','2','10');
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('13','1','10');
INSERT INTO `prato_cardapio` (`id`,`prato_id`,`cardapio_id`) VALUES
('14','1','11');



-- -------------------------------------------
-- TABLE DATA produto
-- -------------------------------------------
INSERT INTO `produto` (`id`,`descricao`,`categoria_id`,`unidade_id`) VALUES
('1','Biscoito','11','2');
INSERT INTO `produto` (`id`,`descricao`,`categoria_id`,`unidade_id`) VALUES
('2','Carne ','2','1');
INSERT INTO `produto` (`id`,`descricao`,`categoria_id`,`unidade_id`) VALUES
('3','Arroz','6','1');
INSERT INTO `produto` (`id`,`descricao`,`categoria_id`,`unidade_id`) VALUES
('4','Feijão','6','1');
INSERT INTO `produto` (`id`,`descricao`,`categoria_id`,`unidade_id`) VALUES
('5','Alface','12','1');
INSERT INTO `produto` (`id`,`descricao`,`categoria_id`,`unidade_id`) VALUES
('6','Frango','8','1');
INSERT INTO `produto` (`id`,`descricao`,`categoria_id`,`unidade_id`) VALUES
('7','Leite','7','2');



-- -------------------------------------------
-- TABLE DATA produto_prato
-- -------------------------------------------
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('1','1','4');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('2','1','2');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('3','1','6');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('4','2','3');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('5','3','6');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('6','4','5');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('7','5','2');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('8','5','6');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('9','6','5');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('10','6','7');
INSERT INTO `produto_prato` (`id`,`prato_id`,`produto_id`) VALUES
('11','7','2');



-- -------------------------------------------
-- TABLE DATA refeicao
-- -------------------------------------------
INSERT INTO `refeicao` (`id`,`descricao`) VALUES
('1','Almoço');
INSERT INTO `refeicao` (`id`,`descricao`) VALUES
('2','Café da manhã');
INSERT INTO `refeicao` (`id`,`descricao`) VALUES
('3','Janta');



-- -------------------------------------------
-- TABLE DATA unidade
-- -------------------------------------------
INSERT INTO `unidade` (`id`,`descricao`) VALUES
('1','KG');
INSERT INTO `unidade` (`id`,`descricao`) VALUES
('2','Caixa');
INSERT INTO `unidade` (`id`,`descricao`) VALUES
('3','Fardo');
INSERT INTO `unidade` (`id`,`descricao`) VALUES
('4','Litro');



-- -------------------------------------------
-- TABLE DATA usuarios
-- -------------------------------------------
INSERT INTO `usuarios` (`id`,`nome`,`cpf`,`rg`,`email`,`telefone`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`role`,`password_hash`,`isAtivo`,`codVerificacao`) VALUES
('2','discente','637.544.375-67','8745687687','discente@gmail.com','(87)23666-4656','Rua Bahia','765','','Centro','Itacarambi','Minas Gerais','3','$2y$13$PWBTZHZ7ga0K9Ui851ovc.yOPrin2vgUveWoOcWrkSAzipBH40sQi','1','0');
INSERT INTO `usuarios` (`id`,`nome`,`cpf`,`rg`,`email`,`telefone`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`role`,`password_hash`,`isAtivo`,`codVerificacao`) VALUES
('3','Nutricionista','989.371.583-65','7863825619','nutricionista@gmail.com','(98)73896-1875','Rua Tal','90','','Centro','Januária','Minas Gerais','2','$2y$13$GmkUL8nPEsn6C7XbMsLm4ON3TgTdivNY7mgutWdKG7/MOY9fPIN8y','1','06cac183');
INSERT INTO `usuarios` (`id`,`nome`,`cpf`,`rg`,`email`,`telefone`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`role`,`password_hash`,`isAtivo`,`codVerificacao`) VALUES
('4','admin','878.623.755-55','8786537333','admin@gmail.com','(38)09049-0387','Rua Bahia','123','Casa','São José','Itacarambi','Minas Gerais','1','$2y$13$EMp3N4Qw/0Un01rYNpVwmOtd0lAnC4Dv61iedgYRmX5/L07xdUHIW','1','0');
INSERT INTO `usuarios` (`id`,`nome`,`cpf`,`rg`,`email`,`telefone`,`rua`,`numero`,`complemento`,`bairro`,`cidade`,`estado`,`role`,`password_hash`,`isAtivo`,`codVerificacao`) VALUES
('5','Micilene Santos','238.617.568-76','6753651723','micilene@gmail.com','(38)99999-9999','','','','','','','2','$2y$13$qtKvOzHd.W0rutclTWMkBO.s5niRhx1BAOOfHL61UmhyrCYOXHzYe','0','0');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------

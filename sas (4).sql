-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/08/2024 às 16:22
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `chave` varchar(50) NOT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `acessos`
--

INSERT INTO `acessos` (`id`, `nome`, `chave`, `grupo`) VALUES
(1, 'Home', 'home', 0),
(2, 'Clientes', 'clientes', 2),
(3, 'Usuários', 'usuarios', 3),
(4, 'Funcionários', 'funcionarios', 2),
(5, 'Fornecedores', 'fornecedores', 2),
(6, 'Cargos', 'cargos', 3),
(7, 'Frequências', 'frequencias', 2),
(10, 'Categorias', 'categorias', 4),
(11, 'Produtos', 'produtos', 4),
(12, 'Entradas', 'entradas', 4),
(13, 'Saídas', 'saidas', 4),
(14, 'Estoque', 'estoque', 4),
(15, 'Trocas', 'trocas', 4),
(16, 'Contas à Receber', 'receber', 5),
(17, 'Despesas', 'pagar', 5),
(18, 'Compras', 'compras', 5),
(22, 'Relatório de Vendas', 'rel_vendas', 6),
(23, 'Relatório de Clientes', 'rel_clientes', 6),
(24, 'Relatório de Recebimentos', 'rel_recebimentos', 6),
(25, 'Relatório de Despesas', 'rel_despesas', 6),
(26, 'Relatório de Lucro', 'rel_lucro', 6),
(27, 'Relatório de Produtos', 'rel_produtos', 6),
(28, 'Relatório de Estoque', 'rel_estoque', 6),
(29, 'Relatório de Entrada/Saída', 'rel_entradas_saidas', 6),
(30, 'Relatório de Caixas', 'rel_caixas', 6),
(31, 'Relatório de Comissões', 'rel_comissoes', 6),
(34, 'Configurações', 'config', 0),
(35, 'Relatório de Trocas', 'rel_trocas', 6),
(36, 'Relatório Vendas Produtos', 'rel_vendas_produtos', 6),
(37, 'Administração Central', 'administracao', 7),
(38, 'Centro de Simulação', 'centro_de_simulacao', 7);

-- --------------------------------------------------------

--
-- Estrutura para tabela `alertas`
--

CREATE TABLE `alertas` (
  `id` int(11) NOT NULL,
  `titulo_alerta` varchar(20) NOT NULL,
  `titulo_mensagem` varchar(100) NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `data` date NOT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data_cad` date NOT NULL,
  `data_validade` date DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `id_ref` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixa`
--

CREATE TABLE `caixa` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `data_ab` date NOT NULL,
  `hora_ab` time NOT NULL,
  `valor_ab` decimal(8,2) NOT NULL,
  `gerente_ab` int(11) NOT NULL,
  `data_fec` date DEFAULT NULL,
  `hora_fec` time DEFAULT NULL,
  `valor_fec` decimal(8,2) DEFAULT NULL,
  `valor_vendido` decimal(8,2) DEFAULT NULL,
  `valor_quebra` decimal(8,2) DEFAULT NULL,
  `gerente_fec` int(11) DEFAULT NULL,
  `caixa` int(11) NOT NULL,
  `operador` int(11) DEFAULT NULL,
  `status` varchar(35) DEFAULT NULL,
  `valor_sangrias` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `caixas`
--

CREATE TABLE `caixas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `empresa` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cargos`
--

INSERT INTO `cargos` (`id`, `empresa`, `nome`) VALUES
(0, 26, 'Gerente'),
(1, 26, 'Presidência'),
(2, 26, 'Vice-Presidência'),
(4, 26, 'Diretoria executiva'),
(5, 26, 'Gerente técnico'),
(6, 26, 'Gerente Administrativo'),
(7, 26, 'Gerente Financeiro'),
(8, 26, 'Analista TI'),
(9, 26, 'Auxiliar Administrativo'),
(10, 26, 'Auxiliar Financeiro'),
(11, 26, 'Analista Financeiro'),
(12, 26, 'Instrutoria'),
(13, 26, 'Assessor'),
(14, 26, 'Consultor'),
(15, 26, 'Estágiario'),
(58, 26, 'Administrador');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cargos_ipb`
--

CREATE TABLE `cargos_ipb` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cargos_ipb`
--

INSERT INTO `cargos_ipb` (`id`, `empresa`, `nome`) VALUES
(1, 26, 'Administrador'),
(2, 26, 'Vice-Presidência'),
(3, 26, 'Diretoria Executiva'),
(4, 26, 'Diretoria Técnica'),
(5, 26, 'Diretoria Financeira'),
(6, 26, 'Gerência Técnica-Administrativa-Financeira'),
(7, 26, 'Gerência Técnica'),
(8, 26, 'Gerência Administrativa-Financeira'),
(9, 26, 'Gerência Administrativa'),
(10, 26, 'Gerência Financeira'),
(11, 26, 'Consultor Naval e Instrutor'),
(12, 26, 'Consultor Naval'),
(13, 26, 'Instrutor'),
(14, 26, 'Analista de TI'),
(15, 26, 'Analista Financeiro'),
(16, 26, 'Auxiliar Administrativo-Financeiro'),
(17, 26, 'Estagiário TI'),
(18, 26, 'Presidência'),
(19, 26, 'Estagiário');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cat_grade`
--

CREATE TABLE `cat_grade` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `centros_custo`
--

CREATE TABLE `centros_custo` (
  `empresa` int(2) NOT NULL,
  `nome` varchar(24) NOT NULL,
  `descricao` text DEFAULT NULL,
  `orcamento` double DEFAULT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `centros_custo`
--

INSERT INTO `centros_custo` (`empresa`, `nome`, `descricao`, `orcamento`, `tipo`) VALUES
(26, 'Administração Central', '', 0, 'Não Produtivo'),
(26, 'Centro de Simulação', '', 0, 'Não Produtivo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `porte` varchar(60) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `inscricao_estadual` varchar(20) NOT NULL,
  `inscricao_municipal` varchar(20) NOT NULL,
  `atividade_economica` varchar(255) NOT NULL,
  `natureza` varchar(255) NOT NULL,
  `logradouro` varchar(120) NOT NULL,
  `num_casa` varchar(20) NOT NULL,
  `complemento` varchar(60) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `municipio` varchar(60) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `data` date NOT NULL,
  `pessoa` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `comissoes`
--

CREATE TABLE `comissoes` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_pgto` date DEFAULT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `id_ref` int(11) NOT NULL,
  `vendedor` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome_sistema` varchar(50) NOT NULL,
  `telefone_sistema` varchar(20) DEFAULT NULL,
  `email_sistema` varchar(50) DEFAULT NULL,
  `tipo_rel` varchar(5) NOT NULL,
  `dias_bloqueio` int(11) NOT NULL,
  `msg_bloqueio` varchar(255) DEFAULT NULL,
  `foto_rel` varchar(100) DEFAULT NULL,
  `tipo_desconto` varchar(20) DEFAULT NULL,
  `comissao` int(11) NOT NULL,
  `endereco_sistema` varchar(150) DEFAULT NULL,
  `cnpj_sistema` varchar(25) DEFAULT NULL,
  `teste` varchar(5) NOT NULL,
  `dias_teste` int(11) NOT NULL,
  `horario_mensagens` time NOT NULL,
  `data` date DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `instancia` varchar(100) DEFAULT NULL,
  `token_pix` varchar(255) DEFAULT NULL,
  `chave_pix_sistema` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `config`
--

INSERT INTO `config` (`id`, `empresa`, `nome_sistema`, `telefone_sistema`, `email_sistema`, `tipo_rel`, `dias_bloqueio`, `msg_bloqueio`, `foto_rel`, `tipo_desconto`, `comissao`, `endereco_sistema`, `cnpj_sistema`, `teste`, `dias_teste`, `horario_mensagens`, `data`, `token`, `instancia`, `token_pix`, `chave_pix_sistema`) VALUES
(1, 0, 'Praticagem do Brasil', '(31) 97527-5084', 'contato@hugocursos.com.br', 'PDF', 3, 'Prezado Cliente, não identificamos o pagamento de sua última mensalidade, entre em contato conosco o mais rápido possivel para regularizar o pagamento, caso contário seu acesso ao sistema será desativado.', NULL, NULL, 0, NULL, NULL, 'Sim', 3, '00:00:00', '2024-08-20', 'DBFY7-5NP-090U0', '54T270623112109OWN96', NULL, NULL),
(16, 26, 'Instituto de Praticagem do Brasil', '(61) 99999-9999', 'suporte@institutopraticagem.org.br', 'PDF', 0, NULL, 'logo-rel.jpg', '%', 0, 'SIA Trecho 17, Rua 03, nº 600, 2º Andar, Zona Industrial, Guará, Brasília, Distrito Federal, CEP nº 71.200-207', '46.836.930/0001-80', '', 0, '00:00:00', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `contratos`
--

CREATE TABLE `contratos` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `texto` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `despesas_viagens`
--

CREATE TABLE `despesas_viagens` (
  `id` int(11) NOT NULL,
  `id_pagamento` int(11) NOT NULL,
  `descricao_viagem` text DEFAULT NULL,
  `fornecedor` varchar(50) NOT NULL,
  `num_fatura` varchar(11) DEFAULT NULL,
  `valor_fatura` decimal(8,2) NOT NULL,
  `responsavel` varchar(60) DEFAULT NULL,
  `usuario` varchar(60) NOT NULL,
  `centro_de_custo` varchar(60) DEFAULT NULL,
  `sub_centro` varchar(20) DEFAULT NULL,
  `arquivo` varchar(100) NOT NULL,
  `data_emiss_fat` date NOT NULL,
  `data_venc_fat` date NOT NULL,
  `data_pgto_fat` date NOT NULL,
  `usuario_lanc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `despesas_viagens`
--

INSERT INTO `despesas_viagens` (`id`, `id_pagamento`, `descricao_viagem`, `fornecedor`, `num_fatura`, `valor_fatura`, `responsavel`, `usuario`, `centro_de_custo`, `sub_centro`, `arquivo`, `data_emiss_fat`, `data_venc_fat`, `data_pgto_fat`, `usuario_lanc`) VALUES
(28, 0, '', '', '12', 2321.32, NULL, '', NULL, NULL, '24-06-2024-09-46-21-37-Fatura-12-Lá-e-Cá-Viagens_20.05.2024.pdf', '0000-00-00', '0000-00-00', '0000-00-00', 59),
(30, 0, '', '', '13', 0.00, NULL, '', NULL, NULL, 'sem-foto.png', '0000-00-00', '0000-00-00', '0000-00-00', 59),
(33, 27, 'amd', '1', '123', 2374.33, NULL, '', NULL, NULL, '12-07-2024-10-33-25-34-NF-203-Usineli-Curso-Operador_12.04.2024.pdf', '2024-07-12', '2024-07-17', '2024-07-22', 59),
(34, 28, 'hdjkzshdkjhiszhdjsklh', '1', '12345', 1200.00, NULL, '', NULL, NULL, '12-07-2024-10-51-45-2.-EE_040.2024_V8_Coord.pdf', '2024-07-12', '2024-07-17', '2024-07-22', 59),
(35, 35, 'kdfyudslfsdjgofyi', '1', '0112', 1231.23, NULL, '', NULL, NULL, 'sem-foto.png', '2024-08-20', '2024-08-25', '2024-08-21', 59);

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes_grade`
--

CREATE TABLE `detalhes_grade` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `id_ref` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `cat_grade` int(11) DEFAULT NULL,
  `itens_grade` int(11) DEFAULT NULL,
  `cat_grade2` int(11) DEFAULT NULL,
  `itens_grade2` int(11) DEFAULT NULL,
  `tipo` varchar(20) NOT NULL,
  `empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes_nota`
--

CREATE TABLE `detalhes_nota` (
  `id` int(20) NOT NULL,
  `id_ref` int(20) NOT NULL,
  `numero_documento_ref` varchar(100) NOT NULL,
  `descricao` varchar(40) NOT NULL,
  `quantidade` varchar(4) NOT NULL,
  `centro_de_custo` varchar(21) NOT NULL,
  `sub_centro` varchar(30) NOT NULL,
  `classificacao` varchar(16) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL,
  `desconto` decimal(8,2) NOT NULL,
  `data_pgto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `detalhes_nota`
--

INSERT INTO `detalhes_nota` (`id`, `id_ref`, `numero_documento_ref`, `descricao`, `quantidade`, `centro_de_custo`, `sub_centro`, `classificacao`, `valor_unitario`, `desconto`, `data_pgto`) VALUES
(16, 34, '', 'kfsdjçlfk', '34', 'Administração Central', 'Banheiros 2', 'Despesa Variável', 111.11, 0.00, '0000-00-00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `detalhes_viagem`
--

CREATE TABLE `detalhes_viagem` (
  `id` int(11) NOT NULL,
  `id_viagem` int(11) NOT NULL,
  `id_fatura` int(11) NOT NULL,
  `num_fatura` varchar(11) DEFAULT NULL,
  `responsavel` varchar(60) DEFAULT NULL,
  `usuario` varchar(60) NOT NULL,
  `centro_de_custo` varchar(60) DEFAULT NULL,
  `sub_centro` varchar(20) DEFAULT NULL,
  `arquivo` varchar(60) NOT NULL,
  `trecho_voo` varchar(15) NOT NULL,
  `loc_cia` varchar(11) NOT NULL,
  `companhia_aerea` varchar(50) NOT NULL,
  `data_ida` date NOT NULL,
  `data_volta` date DEFAULT NULL,
  `valor_aereo` decimal(8,2) DEFAULT NULL,
  `valor_tarifa_aereo` decimal(8,2) NOT NULL,
  `valor_alt_voo` decimal(8,2) DEFAULT NULL,
  `taxa_du_rav` decimal(8,2) NOT NULL,
  `taxa_embarque` decimal(8,2) NOT NULL,
  `taxa_assento` decimal(8,2) NOT NULL,
  `taxa_voo` decimal(8,2) NOT NULL,
  `credito` decimal(8,2) NOT NULL,
  `alteracao` varchar(3) DEFAULT NULL,
  `alteracao_voo` varchar(3) NOT NULL,
  `taxa_alteracao` decimal(8,2) DEFAULT NULL,
  `data_emiss_fat` date NOT NULL,
  `data_venc_fat` date NOT NULL,
  `data_pgto_fat` date NOT NULL,
  `fatura_hospedagem` varchar(11) DEFAULT NULL,
  `tarifa_hospedagem` decimal(8,2) DEFAULT NULL,
  `hospedagem` varchar(60) NOT NULL,
  `all_inclusive` decimal(8,2) NOT NULL,
  `valor_hospedagem` decimal(8,2) NOT NULL,
  `taxa_hospedagem` decimal(8,2) NOT NULL,
  `total_hospedagem` decimal(8,2) DEFAULT NULL,
  `data_check_in` date NOT NULL,
  `data_check_out` date NOT NULL,
  `agendado` varchar(3) NOT NULL,
  `cancelado` varchar(3) NOT NULL,
  `cancelado_voo` varchar(3) NOT NULL,
  `cancelado_hosp` varchar(3) NOT NULL,
  `reembolso` varchar(3) NOT NULL,
  `utilizado` varchar(3) NOT NULL,
  `alteracao_hosp` varchar(4) NOT NULL,
  `transfer_voo` decimal(8,2) DEFAULT NULL,
  `taxa_transfer` decimal(8,2) DEFAULT NULL,
  `total_transfer` decimal(8,2) DEFAULT NULL,
  `valor_alimentacao` decimal(8,2) DEFAULT NULL,
  `valor_trans_terrestre` decimal(8,2) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `reembolso_TA` varchar(3) NOT NULL,
  `usuario_lanc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `detalhes_viagem`
--

INSERT INTO `detalhes_viagem` (`id`, `id_viagem`, `id_fatura`, `num_fatura`, `responsavel`, `usuario`, `centro_de_custo`, `sub_centro`, `arquivo`, `trecho_voo`, `loc_cia`, `companhia_aerea`, `data_ida`, `data_volta`, `valor_aereo`, `valor_tarifa_aereo`, `valor_alt_voo`, `taxa_du_rav`, `taxa_embarque`, `taxa_assento`, `taxa_voo`, `credito`, `alteracao`, `alteracao_voo`, `taxa_alteracao`, `data_emiss_fat`, `data_venc_fat`, `data_pgto_fat`, `fatura_hospedagem`, `tarifa_hospedagem`, `hospedagem`, `all_inclusive`, `valor_hospedagem`, `taxa_hospedagem`, `total_hospedagem`, `data_check_in`, `data_check_out`, `agendado`, `cancelado`, `cancelado_voo`, `cancelado_hosp`, `reembolso`, `utilizado`, `alteracao_hosp`, `transfer_voo`, `taxa_transfer`, `total_transfer`, `valor_alimentacao`, `valor_trans_terrestre`, `observacoes`, `reembolso_TA`, `usuario_lanc`) VALUES
(1, 1, 0, '12', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(2, 2, 0, '12', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Sim', 59),
(3, 3, 0, '12', '', 'Jaqueline', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(4, 4, 0, '12', '', 'Jaqueline', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(5, 5, 0, '12', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Sim', 59),
(6, 4, 0, '1', '', 'Jaqueline', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 1235.46, 0.00, 0.00, 0.00, 0.00, 0.00, 'Sim', 'Sim', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(14, 6, 0, '123', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(15, 7, 0, '12', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(16, 8, 0, '12', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Sim', 'Sim', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(17, 8, 0, '12', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(18, 9, 0, '12345', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Sim', 'Sim', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(19, 9, 0, '12345', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59),
(20, 9, 0, '12345', '', '', '', '', '', '', '', '', '0000-00-00', '0000-00-00', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', 'Não', NULL, '0000-00-00', '0000-00-00', '0000-00-00', '', NULL, '', 0.00, 0.00, 0.00, 0.00, '0000-00-00', '0000-00-00', 'Não', '', 'Não', 'Não', 'Não', 'Não', 'Não', 0.00, 0.00, 0.00, 0.00, 0.00, '', 'Não', 59);

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `ativo` varchar(5) NOT NULL,
  `data_cad` date DEFAULT NULL,
  `data_pgto` date DEFAULT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `teste` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `empresas`
--

INSERT INTO `empresas` (`id`, `nome`, `telefone`, `email`, `cpf`, `cnpj`, `ativo`, `data_cad`, `data_pgto`, `valor`, `endereco`, `teste`) VALUES
(26, 'Praticagem do Brasil', '', 'suporte@institutopraticagem.org.br', '', '', 'Sim', '2023-12-06', '0000-00-00', 0.00, '', 'Não');

-- --------------------------------------------------------

--
-- Estrutura para tabela `entradas`
--

CREATE TABLE `entradas` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamentos`
--

CREATE TABLE `equipamentos` (
  `id` int(5) NOT NULL,
  `tipo` varchar(32) DEFAULT NULL,
  `modelo` varchar(32) DEFAULT NULL,
  `marca` varchar(32) DEFAULT NULL,
  `codigo` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `forma_pgtos`
--

CREATE TABLE `forma_pgtos` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `acrescimo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `porte` varchar(60) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `inscricao_estadual` varchar(20) NOT NULL,
  `inscricao_municipal` varchar(20) NOT NULL,
  `atividade_economica` varchar(255) NOT NULL,
  `natureza` varchar(255) NOT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `telefone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `data` date NOT NULL,
  `pessoa` varchar(25) NOT NULL,
  `logradouro` varchar(120) NOT NULL,
  `num_casa` varchar(20) NOT NULL,
  `complemento` varchar(60) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(60) NOT NULL,
  `municipio` varchar(60) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `nome_banco` varchar(25) NOT NULL,
  `numero_banco` varchar(3) DEFAULT NULL,
  `agencia_fornecedor` varchar(5) DEFAULT NULL,
  `tipo_conta` varchar(15) NOT NULL,
  `numero_conta` varchar(24) DEFAULT NULL,
  `chave_pix` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `empresa`, `nome`, `porte`, `titulo`, `inscricao_estadual`, `inscricao_municipal`, `atividade_economica`, `natureza`, `cpf`, `telefone`, `email`, `data`, `pessoa`, `logradouro`, `num_casa`, `complemento`, `cep`, `bairro`, `municipio`, `uf`, `nome_banco`, `numero_banco`, `agencia_fornecedor`, `tipo_conta`, `numero_conta`, `chave_pix`) VALUES
(1, 26, 'apollo\'s 22', '', '', '23423423234', '23423423432', '', '', '234.342.324-32', '', '', '2024-04-30', 'Física', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `frequencias`
--

CREATE TABLE `frequencias` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `frequencia` varchar(30) NOT NULL,
  `dias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `frequencias`
--

INSERT INTO `frequencias` (`id`, `empresa`, `frequencia`, `dias`) VALUES
(1, 26, 'Mensal', 30),
(2, 26, 'Nenhuma', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupo_acessos`
--

CREATE TABLE `grupo_acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `grupo_acessos`
--

INSERT INTO `grupo_acessos` (`id`, `nome`) VALUES
(2, 'Cadastros'),
(3, 'Pessoas'),
(4, 'Inventário'),
(5, 'Financeiro'),
(6, 'Relatórios'),
(7, 'Centros de Custo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_grade`
--

CREATE TABLE `itens_grade` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `cat_grade` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `estoque` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_venda`
--

CREATE TABLE `itens_venda` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `valor_unitario` decimal(8,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `venda` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `id` int(11) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `nome` varchar(120) NOT NULL,
  `descricao` text DEFAULT NULL,
  `departamento` varchar(60) NOT NULL,
  `entradas` decimal(8,2) NOT NULL,
  `saidas` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagar`
--

CREATE TABLE `pagar` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `numero_documento` varchar(30) NOT NULL,
  `serie_nf` varchar(3) NOT NULL,
  `tipo_pagamento` varchar(30) DEFAULT NULL,
  `conta` varchar(24) DEFAULT NULL,
  `data_emiss` date NOT NULL,
  `data_lanc` date NOT NULL,
  `descricao_pgto` varchar(120) DEFAULT NULL,
  `fornecedor` varchar(50) DEFAULT NULL,
  `chave_nf` varchar(100) DEFAULT NULL,
  `cod_aut` varchar(20) DEFAULT NULL,
  `data_venc` date NOT NULL,
  `data_pgto` date DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `pessoa` int(11) DEFAULT NULL,
  `arquivo` varchar(100) NOT NULL,
  `base_icms` decimal(8,2) DEFAULT NULL,
  `valor_icms` decimal(8,2) DEFAULT NULL,
  `valor_bruto` decimal(8,2) DEFAULT NULL,
  `valor_seguro` decimal(8,2) DEFAULT NULL,
  `pis_pasep` decimal(8,2) DEFAULT NULL,
  `cofins` decimal(8,2) DEFAULT NULL,
  `csll` decimal(8,2) DEFAULT NULL,
  `irrf` decimal(8,2) DEFAULT NULL,
  `iss` decimal(8,2) DEFAULT NULL,
  `valor_frete` decimal(8,2) DEFAULT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `valor_ipi` decimal(8,2) DEFAULT NULL,
  `valor_nota` decimal(8,2) NOT NULL,
  `compensacao` varchar(3) NOT NULL,
  `frequencia` varchar(10) NOT NULL,
  `centro_de_custo` varchar(30) DEFAULT NULL,
  `sub_centro` varchar(40) DEFAULT NULL,
  `classificacao` varchar(20) NOT NULL,
  `reembolso` varchar(3) NOT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_pgto` int(11) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `saida` varchar(50) DEFAULT NULL,
  `tag` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pagar`
--

INSERT INTO `pagar` (`id`, `empresa`, `numero_documento`, `serie_nf`, `tipo_pagamento`, `conta`, `data_emiss`, `data_lanc`, `descricao_pgto`, `fornecedor`, `chave_nf`, `cod_aut`, `data_venc`, `data_pgto`, `valor`, `pessoa`, `arquivo`, `base_icms`, `valor_icms`, `valor_bruto`, `valor_seguro`, `pis_pasep`, `cofins`, `csll`, `irrf`, `iss`, `valor_frete`, `desconto`, `valor_ipi`, `valor_nota`, `compensacao`, `frequencia`, `centro_de_custo`, `sub_centro`, `classificacao`, `reembolso`, `usuario_lanc`, `usuario_pgto`, `pago`, `id_ref`, `saida`, `tag`) VALUES
(15, 26, '', '', 'Fatura', NULL, '2024-06-26', '2024-06-26', '', '1', '', '', '2024-07-01', '2024-07-01', 13215.64, 1, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 59, 'Sim', NULL, NULL, ''),
(16, 26, '', '', 'Fatura', NULL, '2024-06-27', '2024-06-27', 'asdlkasçldkaslkdã', '', '', '', '2024-06-30', '2024-06-27', 12232.45, 0, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 'Não', '0', 'Administração Central', 'Gerência Administrativa', 'Custo Variável', 'Sim', 59, 59, 'Sim', NULL, NULL, ''),
(17, 26, '', '', '', NULL, '2024-07-08', '2024-07-08', '', '', '', '', '2024-07-13', '0000-00-00', 4989.32, 0, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, ''),
(27, 26, '123', '', 'Fatura - Viagem', NULL, '2024-07-12', '2024-07-12', 'amd', '1', '', '', '2024-07-17', '2024-07-22', 2374.33, 1, '12-07-2024-10-33-25-34-NF-203-Usineli-Curso-Operador_12.04.2024.pdf', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, ''),
(28, 26, '12345', '', 'Fatura - Viagem', NULL, '2024-07-12', '2024-07-12', 'hdjkzshdkjhiszhdjsklh', '1', '', '', '2024-07-17', '2024-07-22', 1200.00, 1, '12-07-2024-10-51-45-2.-EE_040.2024_V8_Coord.pdf', 100.00, 101.00, 103.00, 102.00, 105.00, 106.00, 107.00, 108.00, 109.00, 110.00, 111.00, 104.00, 112.00, 'Sim', '30', 'Administração Central', 'Banheiros 2', 'Custo Variável', 'Sim', 59, 0, 'Não', NULL, NULL, 'TAG TAG'),
(29, 26, '', '', '', NULL, '2024-08-11', '2024-08-11', '', '', '', '', '2024-08-16', '0000-00-00', 5.55, 0, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, ''),
(30, 26, '', '', '', NULL, '2024-08-11', '2024-08-11', '', '', '', '', '2024-08-16', '0000-00-00', 555.55, 0, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, ''),
(31, 26, '', '', '', NULL, '2024-08-11', '2024-08-11', '', '', '', '', '2024-08-16', '0000-00-00', 505.55, 0, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, ''),
(32, 26, '', '', '', NULL, '2024-08-11', '2024-08-11', '', '', '', '', '2024-08-16', '0000-00-00', 555.55, 0, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, ''),
(33, 26, '', '', '', NULL, '2024-08-11', '2024-08-11', '', '', '', '', '2024-08-16', '0000-00-00', 555.55, 0, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, ''),
(34, 26, '', '', '', NULL, '2024-08-11', '2024-08-11', '', '', '', '', '2024-08-16', '0000-00-00', 55.55, 0, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, ''),
(35, 26, '0112', '', 'Fatura - Viagem', NULL, '2024-08-20', '2024-08-20', 'kdfyudslfsdjgofyi', '1', '', '', '2024-08-25', '2024-08-21', 1231.23, 1, 'sem-foto.png', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 'Não', '0', '', '', 'Despesa Variável', 'Não', 59, 0, 'Não', NULL, NULL, 'NGJGJHG');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `valor_venda` decimal(8,2) DEFAULT NULL,
  `valor_compra` decimal(8,2) DEFAULT NULL,
  `lucro` decimal(8,2) DEFAULT NULL,
  `fornecedor` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nivel_estoque` int(11) DEFAULT NULL,
  `vendas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `receber`
--

CREATE TABLE `receber` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `tipo` varchar(30) DEFAULT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `pessoa` int(11) DEFAULT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_lanc` date NOT NULL,
  `data_venc` date DEFAULT NULL,
  `data_pgto` date DEFAULT NULL,
  `usuario_lanc` int(11) NOT NULL,
  `usuario_pgto` int(11) DEFAULT NULL,
  `frequencia` int(11) NOT NULL,
  `saida` varchar(50) DEFAULT NULL,
  `arquivo` varchar(100) NOT NULL,
  `pago` varchar(5) NOT NULL,
  `id_ref` int(11) DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `valor_recebido` decimal(8,2) DEFAULT NULL,
  `troco` decimal(8,2) DEFAULT NULL,
  `desconto` decimal(8,2) DEFAULT NULL,
  `acrescimo` int(11) DEFAULT NULL,
  `vendedor` int(11) DEFAULT NULL,
  `garantia` int(11) NOT NULL,
  `ref_pix` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `saidas`
--

CREATE TABLE `saidas` (
  `id` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sangrias`
--

CREATE TABLE `sangrias` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `usuario` int(11) NOT NULL,
  `caixa` int(11) NOT NULL,
  `id_caixa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sub_centros`
--

CREATE TABLE `sub_centros` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `centro_de_custo` varchar(50) NOT NULL,
  `despesas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sub_centros`
--

INSERT INTO `sub_centros` (`id`, `nome`, `centro_de_custo`, `despesas`) VALUES
(1, 'Banheiros 2', 'Administração Central', 0),
(2, 'Copa 2', 'Administração Central', 0),
(3, 'CPD 2', 'Administração Central', 0),
(4, 'Depósito', 'Administração Central', 0),
(5, 'Diretoria Executiva', 'Administração Central', 0),
(6, 'Espaços Comuns 2', 'Administração Central', 0),
(7, 'Gerência Administrativa', 'Administração Central', 0),
(8, 'Gerência Financeira', 'Administração Central', 0),
(9, 'Outros 2', 'Administração Central', 0),
(10, 'Presidência', 'Administração Central', 0),
(11, 'Salas 2', 'Administração Central', 0),
(12, 'Auditório 2', 'Centro de Simulação', 0),
(13, 'Banheiros 3', 'Centro de Simulação', 0),
(14, 'BigData', 'Centro de Simulação', 0),
(15, 'Caixinha 3 (Outros)', 'Centro de Simulação', 0),
(16, 'Copa 3', 'Centro de Simulação', 0),
(17, 'CPD 3', 'Centro de Simulação', 0),
(18, 'Espaços Comuns 3', 'Centro de Simulação', 0),
(19, 'Espaços de Convivência 3', 'Centro de Simulação', 0),
(20, 'Estações DP', 'Centro de Simulação', 0),
(21, 'Gerência Técnica', 'Centro de Simulação', 0),
(22, 'Sala de Aula', 'Centro de Simulação', 0),
(23, 'Sala de Briefing/Debriefing', 'Centro de Simulação', 0),
(24, 'Sala de Controle', 'Centro de Simulação', 0),
(25, 'Sala de Desenvolvimento', 'Centro de Simulação', 0),
(26, 'Sala de Reunião 2', 'Centro de Simulação', 0),
(27, 'Simulador TMS', 'Centro de Simulação', 0),
(28, 'Simulador TPN-USP', 'Centro de Simulação', 0),
(29, 'Simuladores Navegação Eletrônica', 'Centro de Simulação', 0),
(30, 'Simulador NTPro 6 Class A Bridge', 'Centro de Simulação', 0),
(31, 'Simulador Navi Harbour 4.70', 'Centro de Simulação', 0),
(32, 'Simulador Engine Room Techsim', 'Centro de Simulação', 0),
(33, 'Visita', 'Administração Central', 0),
(34, 'Cursos/Treinamentos/Pesquisas', 'Centro de Simulação', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `trecho_viagem`
--

CREATE TABLE `trecho_viagem` (
  `id` int(11) NOT NULL,
  `num_fatura` varchar(15) NOT NULL,
  `trecho_voo` varchar(15) NOT NULL,
  `loc_cia` varchar(10) NOT NULL,
  `data_ida` date NOT NULL,
  `data_volta` date DEFAULT NULL,
  `valor_aereo` decimal(8,2) DEFAULT NULL,
  `valor_tarifa_aereo` decimal(8,2) NOT NULL,
  `valor_alt_voo` decimal(8,2) DEFAULT NULL,
  `taxa_du_rav` decimal(8,2) NOT NULL,
  `taxa_embarque` decimal(8,2) NOT NULL,
  `taxa_assento` decimal(8,2) NOT NULL,
  `taxa_voo` decimal(8,2) NOT NULL,
  `alteracao_voo` varchar(3) DEFAULT NULL,
  `fatura_hospedagem` varchar(11) DEFAULT NULL,
  `tarifa_hospedagem` decimal(8,2) DEFAULT NULL,
  `hospedagem` varchar(60) NOT NULL,
  `all_inclusive` decimal(8,2) NOT NULL,
  `valor_hospedagem` decimal(8,2) NOT NULL,
  `taxa_hospedagem` decimal(8,2) NOT NULL,
  `total_hospedagem` decimal(8,2) DEFAULT NULL,
  `data_check_in` date NOT NULL,
  `data_check_out` date NOT NULL,
  `agendado` varchar(3) NOT NULL,
  `cancelado` varchar(3) NOT NULL,
  `reembolso` varchar(3) NOT NULL,
  `utilizado` varchar(3) NOT NULL,
  `alteracao_hosp` varchar(3) NOT NULL,
  `transfer_voo` decimal(8,2) DEFAULT NULL,
  `taxa_transfer` decimal(8,2) DEFAULT NULL,
  `total_transfer` decimal(8,2) DEFAULT NULL,
  `valor_alimentacao` decimal(8,2) DEFAULT NULL,
  `valor_trans_terrestre` decimal(8,2) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `alteracao` varchar(3) NOT NULL,
  `usuario_lanc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `trocas`
--

CREATE TABLE `trocas` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `produto_saida` int(11) NOT NULL,
  `produto_entrada` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `pessoa` varchar(10) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `senha` varchar(25) NOT NULL,
  `senha_crip` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  `data` date DEFAULT NULL,
  `logradouro` varchar(50) NOT NULL,
  `num_casa` varchar(20) NOT NULL,
  `complemento` varchar(50) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `bairro` varchar(20) NOT NULL,
  `municipio` varchar(25) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `chave_pix` varchar(50) NOT NULL,
  `contrato` varchar(100) NOT NULL,
  `cpf_cnpj` varchar(18) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_alteracao` date DEFAULT NULL,
  `nome_banco` varchar(20) NOT NULL,
  `numero_banco` int(3) DEFAULT NULL,
  `agencia_usuario` int(5) DEFAULT NULL,
  `tipo_conta` varchar(20) NOT NULL,
  `numero_conta` int(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `empresa`, `nome`, `pessoa`, `telefone`, `cpf`, `email`, `senha`, `senha_crip`, `ativo`, `foto`, `nivel`, `data`, `logradouro`, `num_casa`, `complemento`, `cep`, `bairro`, `municipio`, `uf`, `chave_pix`, `contrato`, `cpf_cnpj`, `data_nascimento`, `data_alteracao`, `nome_banco`, `numero_banco`, `agencia_usuario`, `tipo_conta`, `numero_conta`) VALUES
(1, 26, 'john', '', '', '', 'jjj@jjj.com', '123', '202cb962ac59075b964b07152d234b70', 'Sim', '', 'Diretoria Executiva', '2024-04-16', '', '', '', '', '', '', '', '', 'sem-foto.png', NULL, NULL, NULL, '', NULL, NULL, '', NULL),
(59, 26, 'jonathas Santos', '', '', '059.842.141-64', 'suporte@instituto.org.br', '123', '202cb962ac59075b964b07152d234b70', 'Sim', 'sem-foto.jpg', 'Administrador', '2024-01-16', '0', '0', '0', '0', '0', '0', '0', '', '', NULL, NULL, NULL, '', NULL, NULL, '0', NULL),
(60, 0, 'Administrador SAS', '', NULL, '000.000.000-00', 'contato@hugocursos.com.br', '123', '202cb962ac59075b964b07152d234b70', 'Sim', 'sem-foto.jpg', 'SAS', '2024-03-13', '0', '0', '0', '0', '0', '0', '0', '', '', NULL, NULL, NULL, '', NULL, NULL, '0', NULL),
(69, 26, 'Jonathas', 'Física', '', '', 'john@john.com', '123', '202cb962ac59075b964b07152d234b70', 'Sim', 'sem-foto.jpg', 'Analista de TI', '2024-06-25', '', '', '', '', '', '', '', '', 'sem-foto.png', '000.000.000-00', '0000-00-00', NULL, '', 0, 0, '', 0),
(70, 26, 'akjosdjkaosljdlkas', 'Física', '', NULL, '', '123', '202cb962ac59075b964b07152d234b70', 'Sim', 'sem-foto.jpg', 'Analista de TI', '2024-06-25', '', '', '', '', '', '', '', '', 'sem-foto.png', '', '0000-00-00', NULL, '', 0, 0, '', 0),
(71, 26, 'hqwkdjhsalkfnaklsjd', 'Física', '', NULL, '', '123', '202cb962ac59075b964b07152d234b70', 'Sim', 'sem-foto.jpg', 'Analista de TI', '2024-08-20', '', '', '', '', '', '', '', '', '20-08-2024-09-56-12-2.-EE_040.2024_V8_Coord.pdf', '212.371.273-87', '0000-00-00', NULL, '', 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios_permissoes`
--

CREATE TABLE `usuarios_permissoes` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `permissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios_permissoes`
--

INSERT INTO `usuarios_permissoes` (`id`, `usuario`, `permissao`) VALUES
(1, 66, 1),
(2, 66, 2),
(3, 66, 3),
(4, 66, 4),
(313, 66, 5),
(314, 66, 6),
(315, 66, 7),
(316, 66, 10),
(317, 66, 11),
(318, 66, 12),
(319, 66, 13),
(320, 66, 14),
(321, 66, 15),
(322, 66, 16),
(323, 66, 17),
(324, 66, 18),
(325, 66, 22),
(326, 66, 23),
(327, 66, 24),
(328, 66, 25),
(329, 66, 26),
(330, 66, 27),
(331, 66, 28),
(332, 66, 29),
(333, 66, 30),
(334, 66, 31),
(335, 66, 34),
(336, 66, 35),
(337, 66, 36),
(338, 66, 37),
(339, 66, 38),
(340, 69, 1),
(341, 69, 2),
(342, 69, 3),
(343, 69, 4),
(344, 69, 5),
(345, 69, 6),
(346, 69, 7),
(347, 69, 10),
(348, 69, 11),
(349, 69, 12),
(350, 69, 13),
(351, 69, 14),
(352, 69, 15),
(353, 69, 16),
(354, 69, 17),
(355, 69, 18),
(356, 69, 22),
(357, 69, 23),
(358, 69, 24),
(359, 69, 25),
(360, 69, 26),
(361, 69, 27),
(362, 69, 28),
(363, 69, 29),
(364, 69, 30),
(365, 69, 31),
(366, 69, 34),
(367, 69, 35),
(368, 69, 36),
(369, 69, 37),
(370, 69, 38);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `alertas`
--
ALTER TABLE `alertas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `caixa`
--
ALTER TABLE `caixa`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `caixas`
--
ALTER TABLE `caixas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cargos_ipb`
--
ALTER TABLE `cargos_ipb`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cat_grade`
--
ALTER TABLE `cat_grade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `centros_custo`
--
ALTER TABLE `centros_custo`
  ADD PRIMARY KEY (`nome`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comissoes`
--
ALTER TABLE `comissoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `despesas_viagens`
--
ALTER TABLE `despesas_viagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `detalhes_grade`
--
ALTER TABLE `detalhes_grade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `detalhes_nota`
--
ALTER TABLE `detalhes_nota`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `detalhes_viagem`
--
ALTER TABLE `detalhes_viagem`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `equipamentos`
--
ALTER TABLE `equipamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `forma_pgtos`
--
ALTER TABLE `forma_pgtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `frequencias`
--
ALTER TABLE `frequencias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_grade`
--
ALTER TABLE `itens_grade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pagar`
--
ALTER TABLE `pagar`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `receber`
--
ALTER TABLE `receber`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `saidas`
--
ALTER TABLE `saidas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sangrias`
--
ALTER TABLE `sangrias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `sub_centros`
--
ALTER TABLE `sub_centros`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `trecho_viagem`
--
ALTER TABLE `trecho_viagem`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `trocas`
--
ALTER TABLE `trocas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `alertas`
--
ALTER TABLE `alertas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `caixa`
--
ALTER TABLE `caixa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `caixas`
--
ALTER TABLE `caixas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `cargos_ipb`
--
ALTER TABLE `cargos_ipb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `cat_grade`
--
ALTER TABLE `cat_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comissoes`
--
ALTER TABLE `comissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `despesas_viagens`
--
ALTER TABLE `despesas_viagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `detalhes_grade`
--
ALTER TABLE `detalhes_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT de tabela `detalhes_nota`
--
ALTER TABLE `detalhes_nota`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `detalhes_viagem`
--
ALTER TABLE `detalhes_viagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `forma_pgtos`
--
ALTER TABLE `forma_pgtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `frequencias`
--
ALTER TABLE `frequencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `grupo_acessos`
--
ALTER TABLE `grupo_acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `itens_grade`
--
ALTER TABLE `itens_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `itens_venda`
--
ALTER TABLE `itens_venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT de tabela `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagar`
--
ALTER TABLE `pagar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `receber`
--
ALTER TABLE `receber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de tabela `saidas`
--
ALTER TABLE `saidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `sangrias`
--
ALTER TABLE `sangrias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `sub_centros`
--
ALTER TABLE `sub_centros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `trecho_viagem`
--
ALTER TABLE `trecho_viagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `trocas`
--
ALTER TABLE `trocas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/06/2023 às 18:31
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controlenf`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `codhash` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `category`
--

INSERT INTO `category` (`id`, `category`, `description`, `active`, `codhash`, `created_at`, `updated_at`) VALUES
(1, 'Lavanderia', 'Lavanderia', 1, 'e0fc04f7-f9c6-45d5-aac9-ff9a07418bd8', '2023-06-08 16:58:51', '2023-06-08 16:58:51'),
(2, 'Alimento', 'Alimento', 1, 'c12bdaa4-6be2-4549-b44c-4016ebf3bb40', '2023-06-08 16:59:04', '2023-06-08 17:31:21'),
(3, 'Transporte', 'Transporte', 1, 'e6cd1957-1f8d-4782-a9b0-e323491b16bf', '2023-06-08 16:59:14', '2023-06-08 16:59:14'),
(4, 'Teste', 'Teste', 0, '166812c8-22c4-418c-824e-04e8820cf98f', '2023-06-08 18:57:58', '2023-06-08 18:58:59');

-- --------------------------------------------------------

--
-- Estrutura para tabela `company`
--

CREATE TABLE `company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cnpj` varchar(100) NOT NULL,
  `company` varchar(100) NOT NULL,
  `business_name` varchar(100) NOT NULL,
  `codhash` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `company`
--

INSERT INTO `company` (`id`, `cnpj`, `company`, `business_name`, `codhash`, `created_at`, `updated_at`) VALUES
(1, '02.384.284/0001-92', 'Igor e Hugo Lavanderia ME', 'Igor e Hugo Lavanderia ME', 'f265ee20-bc14-42f0-a244-f861ad65199f', '2023-06-08 16:57:05', '2023-06-08 16:57:05'),
(2, '00.796.588/0001-31', 'Juan e Daniela Alimentos Ltda', 'Juan e Daniela Alimentos Ltda', 'e19c2ca3-b1b0-45ab-afbd-b20cd2bb988f', '2023-06-08 16:57:25', '2023-06-08 16:57:25'),
(3, '98.803.049/0001-87', 'Fabiana e Sabrina Transportes Ltda', 'Fabiana e Sabrina Transportes Ltda', 'dacc3095-5f71-4fe9-923a-c0c8aaefd2b8', '2023-06-08 16:57:45', '2023-06-08 16:57:45');

-- --------------------------------------------------------

--
-- Estrutura para tabela `expense`
--

CREATE TABLE `expense` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_company` bigint(20) UNSIGNED DEFAULT NULL,
  `id_category` bigint(20) UNSIGNED DEFAULT NULL,
  `value` varchar(100) NOT NULL,
  `expense` varchar(100) NOT NULL,
  `competition_date` date NOT NULL,
  `receipt_date` date NOT NULL,
  `codhash` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `expense`
--

INSERT INTO `expense` (`id`, `id_user`, `id_company`, `id_category`, `value`, `expense`, `competition_date`, `receipt_date`, `codhash`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, '50,50', 'Lavagem', '2022-01-01', '2022-01-01', 'd552eb62-9db8-408a-a550-76f18bc4178d', '2023-06-08 17:30:28', '2023-06-08 17:30:28'),
(2, 2, 2, 2, '564,00', 'Alimentação', '2022-02-01', '2022-02-01', '5b9a5481-ef7a-41d4-93a0-aba3d4cb089c', '2023-06-08 17:32:00', '2023-06-08 17:32:00'),
(3, 2, 3, 3, '650,00', 'Transporte', '2022-03-01', '2022-03-01', '9ec838b8-ad48-4a67-822c-9068efc0a23c', '2023-06-08 17:32:33', '2023-06-08 17:32:33'),
(4, 2, 1, 2, '350,00', 'Alimentação', '2022-04-04', '2022-04-04', '80209eaf-7070-44d5-be5e-0fe477dde4a4', '2023-06-08 17:33:46', '2023-06-08 17:33:46'),
(5, 2, 3, 3, '100,00', 'Transporte', '2022-05-01', '2022-05-01', '6fda54a7-bdd7-4208-a0fb-ea16f316c17c', '2023-06-08 17:34:21', '2023-06-08 17:34:21'),
(6, 2, 1, 1, '60,00', 'Lavagem', '2022-06-01', '2022-06-01', '093c5d7c-bfd8-4d10-ad94-3d6b0728a774', '2023-06-08 17:34:41', '2023-06-08 17:34:41'),
(7, 2, 2, 2, '80,00', 'Alimentação', '2022-07-01', '2022-07-01', '48482365-28ed-47e9-bb09-b2ef04d5b548', '2023-06-08 17:35:16', '2023-06-08 17:35:16'),
(8, 2, 3, 3, '60,00', 'Transporte', '2022-08-01', '2022-08-01', 'a17ba5f0-9ba1-4d8f-8806-12e00690fd9f', '2023-06-08 17:35:38', '2023-06-08 17:35:38'),
(9, 2, 1, 1, '70,00', 'Lavagem', '2022-09-01', '2022-09-01', 'a56d9eb0-b110-4f55-9494-2213cc12f436', '2023-06-08 17:36:04', '2023-06-08 17:36:04'),
(10, 2, 3, 3, '80,00', 'Transporte', '2022-10-01', '2022-10-01', '4453b559-9373-4a38-bcfb-808082aa59dd', '2023-06-08 17:36:23', '2023-06-08 17:36:23'),
(11, 2, 1, 1, '40,00', 'Lavagem', '2022-11-01', '2022-11-01', '751eb9f0-d34b-4de0-8f48-47b95f3a56c8', '2023-06-08 17:36:44', '2023-06-08 17:36:44'),
(12, 2, 2, 2, '500,00', 'Comida', '2022-12-01', '2022-12-01', '7d0b0f87-d413-40e8-87b1-da8593d45ec7', '2023-06-08 17:37:12', '2023-06-08 17:37:12'),
(13, 2, 1, 1, '50,00', 'Lavagem', '2023-01-01', '2023-01-01', '7fbc8ca8-9c89-48db-96c5-132842388469', '2023-06-08 17:39:45', '2023-06-08 17:39:45'),
(14, 2, 2, 2, '70,00', 'Alimentação', '2023-02-02', '2023-02-02', '893f56c4-42ce-48af-a66e-f0f16fb1a0ab', '2023-06-08 17:40:07', '2023-06-08 17:40:07'),
(15, 2, 3, 3, '90,00', 'Transporte', '2023-03-03', '2023-03-03', '4901b788-b7e8-4000-ac77-e2fe842fb8bf', '2023-06-08 17:40:28', '2023-06-08 17:40:28'),
(16, 2, 1, 1, '60,00', 'Lavagem', '2023-04-04', '2023-04-04', '69b80042-9717-4940-a072-cb19610dc63f', '2023-06-08 17:40:44', '2023-06-08 17:40:44'),
(17, 2, 2, 2, '30,00', 'Alimentação', '2023-05-05', '2023-05-05', '6bfdea5e-bb8a-49c6-8b3a-975b466499cd', '2023-06-08 17:40:59', '2023-06-08 17:41:15'),
(18, 2, 3, 3, '90,00', 'Transporte', '2023-06-06', '2023-06-06', '412978d7-5770-4854-bc8f-40bb0f384aa5', '2023-06-08 17:41:41', '2023-06-08 17:41:41'),
(19, 2, 1, 1, '40,00', 'Lavagem', '2023-07-07', '2023-07-07', '9f6e44ac-c1ab-42ff-8808-34b2fbface6f', '2023-06-08 17:41:54', '2023-06-08 17:41:54'),
(20, 2, 2, 2, '55,00', 'Alimentação', '2023-08-08', '2023-08-08', '72afe70c-4ab5-46de-bc09-a7c525561c33', '2023-06-08 17:42:11', '2023-06-08 17:42:11'),
(21, 2, 1, 1, '70,00', 'Lavagem', '2023-08-08', '2023-08-08', '103a3441-e940-43d8-b7da-d703cf8ff903', '2023-06-08 17:42:41', '2023-06-08 17:42:41'),
(22, 2, 3, 3, '90,00', 'Transporte', '2023-09-09', '2023-09-09', '489fb9dc-0581-464a-87f2-35b0458b5054', '2023-06-08 17:43:01', '2023-06-08 17:43:01'),
(23, 2, 1, 1, '50,00', 'Lavagem', '2023-10-10', '2023-10-10', 'a8d3eb82-6b61-48a2-96f5-4497cc601785', '2023-06-08 17:43:16', '2023-06-08 17:43:16'),
(24, 2, 2, 2, '60,00', 'Alimentação', '2023-11-11', '2023-11-11', '69b01893-a4df-4cef-a26a-411760b437e6', '2023-06-08 17:43:39', '2023-06-08 17:43:39'),
(25, 2, 3, 3, '50,00', 'Transporte', '2023-12-12', '2023-12-12', '265043f5-e970-4cfa-9f6d-06d85f2a8052', '2023-06-08 17:44:01', '2023-06-08 17:44:01');

-- --------------------------------------------------------

--
-- Estrutura para tabela `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `id_company` bigint(20) UNSIGNED NOT NULL,
  `number` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `month_competency` date NOT NULL,
  `receipt_date` date NOT NULL,
  `codhash` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `invoice`
--

INSERT INTO `invoice` (`id`, `id_user`, `id_company`, `number`, `value`, `month_competency`, `receipt_date`, `codhash`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '789745', '1000,00', '2022-01-01', '2022-01-10', '4f52fa44-924d-40ff-86d4-0b489652f666', '2023-06-08 17:01:32', '2023-06-08 17:01:32'),
(2, 2, 1, '789456', '500,00', '2022-01-01', '2022-01-20', 'd6750c67-02da-45ff-bb81-5fd6f8e1e147', '2023-06-08 17:10:53', '2023-06-08 17:12:47'),
(3, 2, 2, '456789', '550,50', '2022-02-01', '2022-02-05', 'e20e3e6d-cabe-447d-bb9f-4a4e0d877fa1', '2023-06-08 17:11:38', '2023-06-08 17:13:04'),
(4, 2, 3, '87654654', '650,00', '2022-02-01', '2022-02-08', 'aa7a31f0-2d61-40b6-ab90-cbfee5f720f1', '2023-06-08 17:11:59', '2023-06-08 17:13:14'),
(5, 2, 1, '54897', '800,00', '2022-03-01', '2022-03-09', 'f1a36878-aebe-4636-a926-720460cbac02', '2023-06-08 17:13:49', '2023-06-08 17:13:49'),
(6, 2, 3, '78651654', '789,00', '2022-04-01', '2022-04-30', 'e123617b-eb9e-41d8-b0ec-52b49c04603e', '2023-06-08 17:14:22', '2023-06-08 17:14:22'),
(7, 2, 1, '6498789', '986,00', '2022-05-01', '2022-05-09', '1d58cfc0-2139-4274-a924-2c3faab0068c', '2023-06-08 17:14:57', '2023-06-08 17:14:57'),
(8, 2, 1, '98764', '546,00', '2022-06-01', '2022-06-21', '5f9f51c3-4cd0-40ce-b0de-c53586001e19', '2023-06-08 17:15:29', '2023-06-08 17:15:29'),
(9, 2, 3, '7894566', '300,00', '2022-07-01', '2022-07-07', '4bc57389-ddc2-4c63-9f40-b257fd7b8dd1', '2023-06-08 17:15:59', '2023-06-08 17:15:59'),
(10, 2, 2, '64987', '571,00', '2022-08-01', '2022-08-08', '693f4cd7-16d0-49f7-836c-68f752929a4d', '2023-06-08 17:16:34', '2023-06-08 17:16:42'),
(11, 2, 3, '321564', '600,87', '2022-09-01', '2022-09-04', '33f915cc-158f-4ab2-84d1-d7901a0ef984', '2023-06-08 17:17:38', '2023-06-08 17:17:38'),
(12, 2, 1, '987897', '459,00', '2022-10-01', '2022-10-14', '50d70e14-b191-4b32-bc14-493fe416aa2f', '2023-06-08 17:18:14', '2023-06-08 17:18:14'),
(13, 2, 1, '646546', '987,00', '2022-11-01', '2022-11-11', '5120e876-2ee3-4acf-b466-922504213807', '2023-06-08 17:18:48', '2023-06-08 17:18:48'),
(14, 2, 3, '89765456', '500,00', '2022-12-01', '2022-12-02', '1ba44770-a314-4df9-91b7-1523591a28a0', '2023-06-08 17:20:06', '2023-06-08 17:20:19'),
(15, 2, 1, '8979846', '456,00', '2023-01-01', '2023-01-10', 'ac3a106d-af61-4785-a942-afb70c79978a', '2023-06-08 17:21:17', '2023-06-08 17:21:17'),
(16, 2, 2, '78574', '1500,00', '2023-02-01', '2023-02-20', '8e1b8d59-87ac-4415-ada2-126b242b5239', '2023-06-08 17:22:13', '2023-06-08 17:22:13'),
(17, 2, 3, '4545', '2000,00', '2023-03-01', '2023-03-01', '2f2905f6-dcb8-4c44-8ed1-09b053a8327e', '2023-06-08 17:22:40', '2023-06-08 17:22:40'),
(18, 2, 3, '456', '3000,00', '2023-03-01', '2023-03-20', '29805255-d94f-4678-87ab-d9f61e54453a', '2023-06-08 17:24:05', '2023-06-08 17:24:05'),
(19, 2, 1, '23145', '5000,00', '2023-04-01', '2023-04-15', '7a70b9cf-d671-4939-a0c6-6774e733807e', '2023-06-08 17:24:36', '2023-06-08 17:24:36'),
(20, 2, 3, '68987', '800,00', '2023-05-01', '2023-05-01', 'f8a22685-1bde-4c04-a28a-0065a584b921', '2023-06-08 17:25:29', '2023-06-08 17:25:29'),
(21, 2, 1, '645897', '789,00', '2023-06-01', '2023-06-01', '34a6630e-244a-4be1-93ab-65bdbbd9a30a', '2023-06-08 17:26:01', '2023-06-08 17:26:01'),
(22, 2, 2, '67879', '9879,00', '2023-07-01', '2023-07-06', 'bceb5c8d-d99f-4b74-9405-32b8aa2daec6', '2023-06-08 17:26:26', '2023-06-08 17:26:26'),
(23, 2, 3, '6497', '2000,00', '2023-08-01', '2023-08-09', '4b2d107f-0c9d-457f-aaf2-367a04e8a98e', '2023-06-08 17:27:25', '2023-06-08 17:27:25'),
(24, 2, 2, '978798', '1500,00', '2023-09-01', '2023-09-01', '73aee33f-8d24-46f3-9129-8bcd4c1bffb9', '2023-06-08 17:27:48', '2023-06-08 17:27:48'),
(25, 2, 3, '64897', '3000,00', '2023-10-01', '2023-10-05', '73b601c9-9f44-4c75-a3db-e30c08b306be', '2023-06-08 17:28:05', '2023-06-08 17:28:05'),
(26, 2, 3, '97897', '3500,50', '2023-11-01', '2023-11-06', '44ed1fa1-cee7-4aaf-9235-d74d2c706fbc', '2023-06-08 17:28:52', '2023-06-08 17:28:52'),
(27, 2, 3, '36987', '6000,00', '2023-12-01', '2023-12-08', '9dad5e2c-fba1-414e-9289-f0cb0d5732fa', '2023-06-08 17:29:19', '2023-06-08 17:29:19');

-- --------------------------------------------------------

--
-- Estrutura para tabela `log_user`
--

CREATE TABLE `log_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event` varchar(100) NOT NULL,
  `codhash` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `log_user`
--

INSERT INTO `log_user` (`id`, `id_user`, `event_type`, `event`, `codhash`, `created_at`, `updated_at`) VALUES
(1, 2, 'LOGOU', ' no sistema cujo id identificador é 2', 'a66589f9-55ab-46b5-ab9b-f455bc8b9d9b', '2023-06-08 16:50:04', '2023-06-08 16:50:04'),
(2, 2, 'CRIOU', ' uma nova Empresa no sistema cujo id identificador é 1', 'c70c0c37-b206-4a2b-95ec-8e20bce11078', '2023-06-08 16:57:05', '2023-06-08 16:57:05'),
(3, 2, 'CRIOU', ' uma nova Empresa no sistema cujo id identificador é 2', '71f53492-7b67-4a12-8a47-6fb59dbc8b05', '2023-06-08 16:57:25', '2023-06-08 16:57:25'),
(4, 2, 'CRIOU', ' uma nova Empresa no sistema cujo id identificador é 3', 'fdfcdacb-f5ee-4a1d-b5fd-8cd1ac2ef723', '2023-06-08 16:57:45', '2023-06-08 16:57:45'),
(5, 2, 'CRIOU', ' uma nova Categoria no sistema cujo id identificador é 1', '62f323f9-d528-4ed1-9a8e-b489c29162bb', '2023-06-08 16:58:51', '2023-06-08 16:58:51'),
(6, 2, 'CRIOU', ' uma nova Categoria no sistema cujo id identificador é 2', '59a58fdb-a363-4b8b-911b-e6b938e318d3', '2023-06-08 16:59:04', '2023-06-08 16:59:04'),
(7, 2, 'CRIOU', ' uma nova Categoria no sistema cujo id identificador é 3', '797bf55a-8e90-4994-8b3f-436e1d123e3d', '2023-06-08 16:59:15', '2023-06-08 16:59:15'),
(8, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 1', 'c99ac501-0551-4a99-8f9b-9983b9422110', '2023-06-08 17:01:32', '2023-06-08 17:01:32'),
(9, 2, 'LOGOU', ' no sistema cujo id identificador é 2', '5bd41b53-d477-4f2a-bc24-5d3dcd4be92a', '2023-06-08 17:05:55', '2023-06-08 17:05:55'),
(10, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 2', '0e781e2d-e447-4c3d-a74c-b8edbc35f619', '2023-06-08 17:10:53', '2023-06-08 17:10:53'),
(11, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 3', '1a09aa53-3505-4498-91bb-9280aa52dc89', '2023-06-08 17:11:38', '2023-06-08 17:11:38'),
(12, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 4', '634a6953-c619-499b-8369-c7fea9fde49f', '2023-06-08 17:11:59', '2023-06-08 17:11:59'),
(13, 2, 'ATUALIZOU', 'uma Nota Fiscal no sistema cujo id identificador é 2', '995cd757-f8d8-4113-b323-0f2831fa779c', '2023-06-08 17:12:47', '2023-06-08 17:12:47'),
(14, 2, 'ATUALIZOU', 'uma Nota Fiscal no sistema cujo id identificador é 3', '984a5db7-f4c9-4e24-9fe5-48b7ae5c41d8', '2023-06-08 17:13:04', '2023-06-08 17:13:04'),
(15, 2, 'ATUALIZOU', 'uma Nota Fiscal no sistema cujo id identificador é 4', '4624f3de-986b-4777-9022-efbc08be4f56', '2023-06-08 17:13:14', '2023-06-08 17:13:14'),
(16, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 5', '80310e63-d4a1-4472-b76b-e0029ce52720', '2023-06-08 17:13:49', '2023-06-08 17:13:49'),
(17, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 6', 'ccc886a3-a007-4d93-a9c5-41fe3d8ddb06', '2023-06-08 17:14:22', '2023-06-08 17:14:22'),
(18, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 7', 'd78a9d34-3fc3-4fe4-b2f1-587aca4a404d', '2023-06-08 17:14:57', '2023-06-08 17:14:57'),
(19, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 8', '229b8d58-174e-495a-9710-c2e34dfd26fd', '2023-06-08 17:15:29', '2023-06-08 17:15:29'),
(20, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 9', '80fcde21-eb2c-47b6-a20b-adeda0314cfc', '2023-06-08 17:15:59', '2023-06-08 17:15:59'),
(21, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 10', '757a49a8-f98a-4ba7-ab2e-a82115a673e4', '2023-06-08 17:16:34', '2023-06-08 17:16:34'),
(22, 2, 'ATUALIZOU', 'uma Nota Fiscal no sistema cujo id identificador é 10', 'd212c539-899d-4cd6-b7a6-d22eb8e53e20', '2023-06-08 17:16:42', '2023-06-08 17:16:42'),
(23, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 11', 'a00a26ec-5587-42d6-9ce8-4fbdca567b80', '2023-06-08 17:17:38', '2023-06-08 17:17:38'),
(24, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 12', '8f0de451-05b7-437a-b11e-7cf383d0066f', '2023-06-08 17:18:14', '2023-06-08 17:18:14'),
(25, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 13', '7384b371-4a9a-49e9-9154-48764d748f7a', '2023-06-08 17:18:48', '2023-06-08 17:18:48'),
(26, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 14', 'fcee8a00-c812-4e1c-ac0c-29d58be831a7', '2023-06-08 17:20:06', '2023-06-08 17:20:06'),
(27, 2, 'ATUALIZOU', 'uma Nota Fiscal no sistema cujo id identificador é 14', '76098339-f641-4eb5-ae82-cf059d785bda', '2023-06-08 17:20:19', '2023-06-08 17:20:19'),
(28, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 15', '03de3302-d432-44a6-8e98-0adf4800625f', '2023-06-08 17:21:17', '2023-06-08 17:21:17'),
(29, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 16', '0311f713-1f0b-405c-b542-c73a533a5aea', '2023-06-08 17:22:13', '2023-06-08 17:22:13'),
(30, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 17', 'a6ab8df7-2d03-401b-b9fc-c9e61597f76f', '2023-06-08 17:22:40', '2023-06-08 17:22:40'),
(31, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 18', '88fee2cb-1d79-4831-92e5-27e94597d0c2', '2023-06-08 17:24:05', '2023-06-08 17:24:05'),
(32, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 19', 'ac5925af-0fa1-413e-a8f1-058d9ab8deff', '2023-06-08 17:24:36', '2023-06-08 17:24:36'),
(33, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 20', '227393cb-9c25-460b-8f14-cf088ee70f64', '2023-06-08 17:25:29', '2023-06-08 17:25:29'),
(34, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 21', 'c349dbe4-f25f-4ab3-8b99-993e27f1e777', '2023-06-08 17:26:01', '2023-06-08 17:26:01'),
(35, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 22', '52087965-6a5d-4b50-bdd3-c7ba6e888055', '2023-06-08 17:26:26', '2023-06-08 17:26:26'),
(36, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 23', '15ebd0bb-f9c9-4607-ae37-c4f87906c0a4', '2023-06-08 17:27:25', '2023-06-08 17:27:25'),
(37, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 24', '8b8f3532-e1bd-4bc1-9009-1da3be3ee262', '2023-06-08 17:27:48', '2023-06-08 17:27:48'),
(38, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 25', '1786ff10-d09b-4dcf-90f2-5494c64a9c79', '2023-06-08 17:28:05', '2023-06-08 17:28:05'),
(39, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 26', '0e7990da-dce7-4b80-9897-8689a428872a', '2023-06-08 17:28:52', '2023-06-08 17:28:52'),
(40, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 27', '3f26de97-b96e-47fc-bf56-388c7e6377ea', '2023-06-08 17:29:19', '2023-06-08 17:29:19'),
(41, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 1', '971d8fd9-edc1-4e08-b3b8-83164f1c8487', '2023-06-08 17:30:28', '2023-06-08 17:30:28'),
(42, 2, 'ATUALIZOU', 'uma Categoria no sistema cujo id identificador é 2', 'e2d80849-6264-4ad5-903e-4d50d5bd5c03', '2023-06-08 17:31:21', '2023-06-08 17:31:21'),
(43, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 2', 'b4ea3e89-2c58-4c9a-af7e-42f3919b63c9', '2023-06-08 17:32:00', '2023-06-08 17:32:00'),
(44, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 3', '54f78a0d-392a-4f90-bcd5-f93efcd7b8e1', '2023-06-08 17:32:33', '2023-06-08 17:32:33'),
(45, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 4', '2ef5a9ae-b05c-4f44-9bdd-73dc35bdf289', '2023-06-08 17:33:46', '2023-06-08 17:33:46'),
(46, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 5', 'b8a51e10-cf1a-455a-83e6-2da93a4f038e', '2023-06-08 17:34:21', '2023-06-08 17:34:21'),
(47, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 6', '2f872783-de11-42f6-92b0-4635e861161e', '2023-06-08 17:34:41', '2023-06-08 17:34:41'),
(48, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 7', '80e1f09a-64a7-4b73-b144-0aa961ddd7b5', '2023-06-08 17:35:16', '2023-06-08 17:35:16'),
(49, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 8', '33eb9c3a-08d1-45e0-b056-9eff50bf343c', '2023-06-08 17:35:38', '2023-06-08 17:35:38'),
(50, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 9', 'daa2e7c2-8776-4a11-977d-5b9034014029', '2023-06-08 17:36:04', '2023-06-08 17:36:04'),
(51, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 10', '91cefc55-b6a9-45d0-8bd2-88f575d9d812', '2023-06-08 17:36:23', '2023-06-08 17:36:23'),
(52, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 11', '12fdfc48-b169-4568-8cce-27443514d1f8', '2023-06-08 17:36:44', '2023-06-08 17:36:44'),
(53, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 12', 'd0d3b26e-e470-44d2-a16b-a02e6ec3d728', '2023-06-08 17:37:12', '2023-06-08 17:37:12'),
(54, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 13', '53fc8b8d-538c-4780-842a-562255b773b6', '2023-06-08 17:39:45', '2023-06-08 17:39:45'),
(55, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 14', '66f5e7b2-5c1a-4ca5-a3aa-b00cd2373ac4', '2023-06-08 17:40:08', '2023-06-08 17:40:08'),
(56, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 15', '340866f5-bef9-46ab-a85b-104b22fde255', '2023-06-08 17:40:28', '2023-06-08 17:40:28'),
(57, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 16', 'f2e88793-62e9-4e04-9157-40b2276b0e7c', '2023-06-08 17:40:44', '2023-06-08 17:40:44'),
(58, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 17', '916ef050-d9c3-4410-974b-60c5dc444813', '2023-06-08 17:40:59', '2023-06-08 17:40:59'),
(59, 2, 'ATUALIZOU', 'uma Despesa no sistema cujo id identificador é 17', '93ea2ec7-88df-47e6-b192-516d78cd10c1', '2023-06-08 17:41:15', '2023-06-08 17:41:15'),
(60, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 18', 'fe8f3d02-1159-4152-ad89-c7a92f14fccc', '2023-06-08 17:41:41', '2023-06-08 17:41:41'),
(61, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 19', '8b3f8e88-651a-4c4a-95e4-219dddbdcb8a', '2023-06-08 17:41:54', '2023-06-08 17:41:54'),
(62, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 20', '8f6e1ea0-3230-4421-9268-14401e124d2b', '2023-06-08 17:42:11', '2023-06-08 17:42:11'),
(63, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 21', '7630541c-a72d-4299-8a8c-b2bbe59fbb26', '2023-06-08 17:42:41', '2023-06-08 17:42:41'),
(64, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 22', 'd5cc6dc1-811e-4858-9b17-4034c0f4549f', '2023-06-08 17:43:01', '2023-06-08 17:43:01'),
(65, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 23', '60d6cfa4-815f-4e31-aff6-9964a70634fc', '2023-06-08 17:43:16', '2023-06-08 17:43:16'),
(66, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 24', 'd5f2b118-17a6-4e5a-9b06-0983cfb69ef1', '2023-06-08 17:43:39', '2023-06-08 17:43:39'),
(67, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 25', '6522cd55-a70c-4e5b-ad20-991ab8bd1aeb', '2023-06-08 17:44:01', '2023-06-08 17:44:01'),
(68, 2, 'LOGOU', ' no sistema cujo id identificador é 2', '724add69-5e0e-4d53-9b9c-3e4ac5414933', '2023-06-08 18:52:01', '2023-06-08 18:52:01'),
(69, 2, 'LOGOU', ' no sistema cujo id identificador é 2', '78939c44-d27e-40bb-99c3-81ca02e74a58', '2023-06-08 18:53:29', '2023-06-08 18:53:29'),
(70, 2, 'LOGOU', ' no sistema cujo id identificador é 2', '6f99909a-dd44-42e6-a3af-66699bd18712', '2023-06-08 18:53:43', '2023-06-08 18:53:43'),
(71, 2, 'LOGOU', ' no sistema cujo id identificador é 2', '0991a572-bb6e-4e05-9427-9d80bb20b3c9', '2023-06-08 18:53:59', '2023-06-08 18:53:59'),
(72, 2, 'CRIOU', ' uma nova Empresa no sistema cujo id identificador é 4', '9bee6a82-aed9-4508-86da-ce7bf4308c86', '2023-06-08 18:56:24', '2023-06-08 18:56:24'),
(73, 2, 'EXCLUIU', ' uma Empresa no sistema', '20e22069-35df-411b-b5fb-e52a025c2175', '2023-06-08 18:57:39', '2023-06-08 18:57:39'),
(74, 2, 'CRIOU', ' uma nova Categoria no sistema cujo id identificador é 4', '16a0d18c-43c2-42ab-a16f-2b76d8ebbd97', '2023-06-08 18:57:58', '2023-06-08 18:57:58'),
(75, 2, 'DESABILITOU', ' uma Categoria no sistema', '85cd4513-deff-438c-93c5-492c2897918a', '2023-06-08 18:58:21', '2023-06-08 18:58:21'),
(76, 2, 'ATUALIZOU', 'uma Categoria no sistema cujo id identificador é 4', '96112c3d-93c1-4a33-98ba-7e211df77a53', '2023-06-08 18:58:28', '2023-06-08 18:58:28'),
(77, 2, 'DESABILITOU', ' uma Categoria no sistema', '6074c567-1d70-4450-84fd-dff033b4ce53', '2023-06-08 18:58:59', '2023-06-08 18:58:59'),
(78, 2, 'CRIOU', ' uma nova Nota Fical no sistema cujo id identificador é 28', 'b23a2382-998c-414a-8314-02d95d3d211d', '2023-06-08 18:59:56', '2023-06-08 18:59:56'),
(79, 2, 'ATUALIZOU', 'uma Nota Fiscal no sistema cujo id identificador é 28', 'c3b23dfd-d85c-4108-859d-a17889ea945d', '2023-06-08 19:01:45', '2023-06-08 19:01:45'),
(80, 2, 'EXCLUIU', ' uma Nota Fiscal no sistema', 'f1e32bed-3fd7-4b39-b45d-6e2b2500951c', '2023-06-08 19:01:57', '2023-06-08 19:01:57'),
(81, 2, 'CRIOU', ' uma nova Despesa no sistema cujo id identificador é 26', '96942458-1b1a-4d51-99d6-6def9ca18424', '2023-06-08 19:02:43', '2023-06-08 19:02:43'),
(82, 2, 'ATUALIZOU', 'uma Despesa no sistema cujo id identificador é 26', '4488ae36-df0b-460c-ad5f-03f6c4937bfa', '2023-06-08 19:03:12', '2023-06-08 19:03:12'),
(83, 2, 'EXCLUIU', ' uma Despesa no sistema', 'c1533788-deb3-4be1-82ba-747a30f779e5', '2023-06-08 19:03:31', '2023-06-08 19:03:31'),
(84, 2, 'ATUALIZOU', 'o valor máximo do MEI para 81500,00', 'fb1467cf-e7de-49c8-84d6-2d381523b288', '2023-06-08 19:03:51', '2023-06-08 19:03:51'),
(85, 2, 'ATUALIZOU', 'o valor máximo do MEI para 90500,00', '275d2503-1248-40d1-8092-60ca5e104cd1', '2023-06-08 19:04:14', '2023-06-08 19:04:14'),
(86, 2, 'ATUALIZOU', 'o valor máximo do MEI para 81000,00', '8e6b9d26-12af-450d-b9a6-c5d1b0e868b0', '2023-06-08 19:04:38', '2023-06-08 19:04:38'),
(87, 2, 'ATUALIZOU', 'um usuárui no sistema cujo id identificador é 2', '372a5873-57d2-4f04-8abb-dc727f31364d', '2023-06-08 19:06:42', '2023-06-08 19:06:42'),
(88, 2, 'ATUALIZOU', 'um usuárui no sistema cujo id identificador é 2', 'c4516e66-b4e7-4f18-94e1-1f8003ecaddc', '2023-06-08 19:06:55', '2023-06-08 19:06:55'),
(89, 1, 'LOGOU', ' no sistema cujo id identificador é 1', '5fefcb10-ab78-46a1-b16b-b03a9de4ba1e', '2023-06-08 19:13:25', '2023-06-08 19:13:25'),
(90, 2, 'LOGOU', ' no sistema cujo id identificador é 2', '7d77d466-303c-484a-8a14-e39954764cd7', '2023-06-08 19:13:57', '2023-06-08 19:13:57');

-- --------------------------------------------------------

--
-- Estrutura para tabela `mei`
--

CREATE TABLE `mei` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `max_value` varchar(100) NOT NULL,
  `codhash` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `mei`
--

INSERT INTO `mei` (`id`, `max_value`, `codhash`, `created_at`, `updated_at`) VALUES
(1, '81000,00', 'c1973523-13b1-406b-ac23-dc19cab90eea', NULL, '2023-06-08 19:04:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2023_05_30_175016_create_profile_table', 1),
(12, '2023_05_30_183522_create_user_table', 1),
(13, '2023_05_31_192111_create_log_user_table', 1),
(14, '2023_05_31_193331_create_company_table', 1),
(15, '2023_05_31_193332_create_invoice_table', 1),
(16, '2023_06_06_132453_create_category_table', 1),
(17, '2023_06_06_132454_create_expense_table', 1),
(18, '2023_06_06_141807_create_mei_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `profile`
--

CREATE TABLE `profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `profile` enum('collaborator','administrator') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `profile`
--

INSERT INTO `profile` (`id`, `profile`, `created_at`, `updated_at`) VALUES
(1, 'collaborator', NULL, NULL),
(2, 'administrator', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_profile` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `alert` enum('desativado','sms','email') NOT NULL,
  `active` tinyint(1) NOT NULL,
  `codhash` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `id_profile`, `name`, `email`, `password`, `phone`, `alert`, `active`, `codhash`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jean Abreu', 'jeandcabreu@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '(21)98890-5241', 'email', 1, 'e7f6dd9e-07b9-43cb-81db-9642590acbac', NULL, '2023-06-08 16:41:23'),
(2, 2, 'Vibbraneo', 'srvibbraneo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '(99)99999-9999', 'email', 1, '9315b04b-a98b-4ac8-8c01-ad2f0e8e5a81', NULL, '2023-06-08 19:06:55');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expense_id_user_foreign` (`id_user`),
  ADD KEY `expense_id_company_foreign` (`id_company`),
  ADD KEY `expense_id_category_foreign` (`id_category`);

--
-- Índices de tabela `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id_user_foreign` (`id_user`),
  ADD KEY `invoice_id_company_foreign` (`id_company`);

--
-- Índices de tabela `log_user`
--
ALTER TABLE `log_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_user_id_user_foreign` (`id_user`);

--
-- Índices de tabela `mei`
--
ALTER TABLE `mei`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_profile_foreign` (`id_profile`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `expense`
--
ALTER TABLE `expense`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `log_user`
--
ALTER TABLE `log_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `mei`
--
ALTER TABLE `mei`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `profile`
--
ALTER TABLE `profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_id_category_foreign` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `expense_id_company_foreign` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `expense_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_id_company_foreign` FOREIGN KEY (`id_company`) REFERENCES `company` (`id`),
  ADD CONSTRAINT `invoice_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `log_user`
--
ALTER TABLE `log_user`
  ADD CONSTRAINT `log_user_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_id_profile_foreign` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

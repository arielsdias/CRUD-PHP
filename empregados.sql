SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `minhabase`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empregados`
--

CREATE TABLE IF NOT EXISTS `empregados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `salario` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Adicionando dados na tabela `empregados`
--

INSERT INTO `empregados` (`id`, `nome`, `endereco`, `salario`) VALUES
(1, 'Carlos Silva', 'Rua da Subida, 67, Brasil', 5000),
(2, 'Victoria Moreira', 'Rua Tiradentes, 44, Brasil', 6500),
(3, 'Livia Bastos', '25, Rue Lauriston, Paris', 8000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

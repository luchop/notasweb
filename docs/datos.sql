SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


INSERT INTO `alumno` (`CodAlumno`, `Paterno`, `Materno`, `Nombres`, `CI`, `RU`, `Activo`) VALUES
(1, 'Picapiedra', 'Paramo', 'Pedro', '11', '', 'S'),
(3, 'Perez', '', 'Juanito ', '123456', '', 'S'),
(4, 'Perez', 'Gomez', 'Juan', '2256888', '1004506', 'S'),
(5, 'Torrez', 'Bacarreza', 'Alejandra', '2244855', '3356887', 'S');

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrador'),
(2, 'docente', 'Docente');

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(3, 0x3a3a31, 'luchop', '$2y$08$wxdVelrlxw4loOYTnuzlCuQAGVvt00wia130WB1xBkLHVpnkLdNDG', NULL, 'luispaezrocha@yahoo.com', '602e68bc9ca363ff3554933ef3291f659c547b9c', NULL, NULL, NULL, 1463538029, 1463626704, 1, 'luis', 'paez', 'sip', '72015767'),
(4, 0x3a3a31, 'dev', '$2y$08$rBxh6.95FAWUtdqr/xV2peN2LOIIuJSqQa6uM5HINpAnuvnlwPXHG', NULL, 'developer@hotmail.com', 'abc3a6b7ff070d8b8f1a5027cf46cdf9d528d328', NULL, NULL, NULL, 1463538203, 1463681513, 1, 'deve', 'loper', 'UPEA', '1234567');

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(4, 3, 2),
(5, 4, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

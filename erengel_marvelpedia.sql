-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 13-12-2025 a las 20:44:12
-- Versión del servidor: 8.0.44-0ubuntu0.24.04.1
-- Versión de PHP: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `erengel_marvelpedia`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('marvelpedia-cache-marvelpedia-cache-pelicula_tt0371746', 'a:26:{s:5:\"adult\";b:0;s:13:\"backdrop_path\";s:32:\"/cKvDv2LpwVEqbdXWoQl4XgGN6le.jpg\";s:21:\"belongs_to_collection\";a:4:{s:2:\"id\";i:131292;s:4:\"name\";s:21:\"Iron Man - Colección\";s:11:\"poster_path\";s:32:\"/9IcmiJNK5cPiYwefR2915DCa9Y1.jpg\";s:13:\"backdrop_path\";s:32:\"/rI8zOWkRQJdlAyQ6WJOSlYK6JxZ.jpg\";}s:6:\"budget\";i:140000000;s:6:\"genres\";a:3:{i:0;a:2:{s:2:\"id\";i:28;s:4:\"name\";s:7:\"Acción\";}i:1;a:2:{s:2:\"id\";i:878;s:4:\"name\";s:16:\"Ciencia ficción\";}i:2;a:2:{s:2:\"id\";i:12;s:4:\"name\";s:8:\"Aventura\";}}s:8:\"homepage\";s:0:\"\";s:2:\"id\";i:1726;s:7:\"imdb_id\";s:9:\"tt0371746\";s:14:\"origin_country\";a:1:{i:0;s:2:\"US\";}s:17:\"original_language\";s:2:\"en\";s:14:\"original_title\";s:8:\"Iron Man\";s:8:\"overview\";s:278:\"El multimillonario fabricante de armas Tony Stark debe enfrentarse a su turbio pasado después de sufrir un accidente con una de sus armas. Equipado con una armadura de última generación tecnológica, se convierte en \'El hombre de hierro\' para combatir el mal a escala global.\";s:10:\"popularity\";d:14.0739;s:11:\"poster_path\";s:32:\"/tFCTNx7foAsUQpgu2x1KjAJD1wT.jpg\";s:20:\"production_companies\";a:3:{i:0;a:4:{s:2:\"id\";i:420;s:9:\"logo_path\";s:32:\"/hUzeosd33nzE5MCNsZxCGEKTXaQ.png\";s:4:\"name\";s:14:\"Marvel Studios\";s:14:\"origin_country\";s:2:\"US\";}i:1;a:4:{s:2:\"id\";i:7505;s:9:\"logo_path\";s:32:\"/837VMM4wOkODc1idNxGT0KQJlej.png\";s:4:\"name\";s:20:\"Marvel Entertainment\";s:14:\"origin_country\";s:2:\"US\";}i:2;a:4:{s:2:\"id\";i:7297;s:9:\"logo_path\";s:32:\"/l29JYQVZbTcjZXoz4CUYFpKRmM3.png\";s:4:\"name\";s:22:\"Fairview Entertainment\";s:14:\"origin_country\";s:2:\"US\";}}s:20:\"production_countries\";a:1:{i:0;a:2:{s:10:\"iso_3166_1\";s:2:\"US\";s:4:\"name\";s:24:\"United States of America\";}}s:12:\"release_date\";s:10:\"2008-04-30\";s:7:\"revenue\";i:585174222;s:7:\"runtime\";i:126;s:16:\"spoken_languages\";a:4:{i:0;a:3:{s:12:\"english_name\";s:7:\"English\";s:9:\"iso_639_1\";s:2:\"en\";s:4:\"name\";s:7:\"English\";}i:1;a:3:{s:12:\"english_name\";s:7:\"Persian\";s:9:\"iso_639_1\";s:2:\"fa\";s:4:\"name\";s:10:\"فارسی\";}i:2;a:3:{s:12:\"english_name\";s:4:\"Urdu\";s:9:\"iso_639_1\";s:2:\"ur\";s:4:\"name\";s:8:\"اردو\";}i:3;a:3:{s:12:\"english_name\";s:6:\"Arabic\";s:9:\"iso_639_1\";s:2:\"ar\";s:4:\"name\";s:14:\"العربية\";}}s:6:\"status\";s:8:\"Released\";s:7:\"tagline\";s:35:\"Los heroes no nacen, se construyen.\";s:5:\"title\";s:8:\"Iron Man\";s:5:\"video\";b:0;s:12:\"vote_average\";d:7.654;s:10:\"vote_count\";i:27505;}', 1765678547),
('marvelpedia-cache-marvelpedia-cache-pelicula_tt20969586', 'a:26:{s:5:\"adult\";b:0;s:13:\"backdrop_path\";s:32:\"/wSdWEc1G3OUWg8HAzNLqOZ9Gd43.jpg\";s:21:\"belongs_to_collection\";N;s:6:\"budget\";i:180000000;s:6:\"genres\";a:3:{i:0;a:2:{s:2:\"id\";i:28;s:4:\"name\";s:7:\"Acción\";}i:1;a:2:{s:2:\"id\";i:878;s:4:\"name\";s:16:\"Ciencia ficción\";}i:2;a:2:{s:2:\"id\";i:12;s:4:\"name\";s:8:\"Aventura\";}}s:8:\"homepage\";s:0:\"\";s:2:\"id\";i:986056;s:7:\"imdb_id\";s:10:\"tt20969586\";s:14:\"origin_country\";a:1:{i:0;s:2:\"US\";}s:17:\"original_language\";s:2:\"en\";s:14:\"original_title\";s:13:\"Thunderbolts*\";s:8:\"overview\";s:395:\"Un grupo de supervillanos poco convencional es reclutado para hacer misiones para el gobierno: Yelena Belova, Bucky Barnes, Red Guardian, Ghost, Taskmaster y John Walker. Después de verse atrapados en una trampa mortal urdida por Valentina Allegra de Fontaine, estos marginados deben embarcarse en una peligrosa misión que les obligará a enfrentarse a los recovecos más oscuros de su pasado.\";s:10:\"popularity\";d:20.2922;s:11:\"poster_path\";s:32:\"/yDWU8YyFkPnlVY627QXPvct8bz9.jpg\";s:20:\"production_companies\";a:2:{i:0;a:4:{s:2:\"id\";i:420;s:9:\"logo_path\";s:32:\"/hUzeosd33nzE5MCNsZxCGEKTXaQ.png\";s:4:\"name\";s:14:\"Marvel Studios\";s:14:\"origin_country\";s:2:\"US\";}i:1;a:4:{s:2:\"id\";i:176762;s:9:\"logo_path\";N;s:4:\"name\";s:23:\"Kevin Feige Productions\";s:14:\"origin_country\";s:2:\"US\";}}s:20:\"production_countries\";a:1:{i:0;a:2:{s:10:\"iso_3166_1\";s:2:\"US\";s:4:\"name\";s:24:\"United States of America\";}}s:12:\"release_date\";s:10:\"2025-04-30\";s:7:\"revenue\";i:382436917;s:7:\"runtime\";i:127;s:16:\"spoken_languages\";a:3:{i:0;a:3:{s:12:\"english_name\";s:7:\"English\";s:9:\"iso_639_1\";s:2:\"en\";s:4:\"name\";s:7:\"English\";}i:1;a:3:{s:12:\"english_name\";s:7:\"Italian\";s:9:\"iso_639_1\";s:2:\"it\";s:4:\"name\";s:8:\"Italiano\";}i:2;a:3:{s:12:\"english_name\";s:7:\"Russian\";s:9:\"iso_639_1\";s:2:\"ru\";s:4:\"name\";s:13:\"Pусский\";}}s:6:\"status\";s:8:\"Released\";s:7:\"tagline\";s:45:\"Todo el mundo merece una segunda oportunidad.\";s:5:\"title\";s:13:\"Thunderbolts*\";s:5:\"video\";b:0;s:12:\"vote_average\";d:7.315;s:10:\"vote_count\";i:2961;}', 1765678547),
('marvelpedia-cache-marvelpedia-cache-pelicula_tt2250912', 'a:26:{s:5:\"adult\";b:0;s:13:\"backdrop_path\";s:32:\"/fn4n6uOYcB6Uh89nbNPoU2w80RV.jpg\";s:21:\"belongs_to_collection\";a:4:{s:2:\"id\";i:531241;s:4:\"name\";s:36:\"Spider-Man (Vengadores) - Colección\";s:11:\"poster_path\";s:32:\"/2E7Jukg8JvyJgKlql7UIWqVwOMU.jpg\";s:13:\"backdrop_path\";s:32:\"/AvnqpRwlEaYNVL6wzC4RN94EdSd.jpg\";}s:6:\"budget\";i:175000000;s:6:\"genres\";a:3:{i:0;a:2:{s:2:\"id\";i:28;s:4:\"name\";s:7:\"Acción\";}i:1;a:2:{s:2:\"id\";i:12;s:4:\"name\";s:8:\"Aventura\";}i:2;a:2:{s:2:\"id\";i:878;s:4:\"name\";s:16:\"Ciencia ficción\";}}s:8:\"homepage\";s:0:\"\";s:2:\"id\";i:315635;s:7:\"imdb_id\";s:9:\"tt2250912\";s:14:\"origin_country\";a:1:{i:0;s:2:\"US\";}s:17:\"original_language\";s:2:\"en\";s:14:\"original_title\";s:22:\"Spider-Man: Homecoming\";s:8:\"overview\";s:462:\"Peter Parker comienza a experimentar su recién descubierta identidad como el superhéroe Spider-Man. Después de la experiencia vivida con los Vengadores, Peter regresa a casa, donde vive con su tía. Bajo la atenta mirada de su mentor Tony Stark, Peter intenta mantener una vida normal como cualquier joven de su edad, pero interrumpe en su rutina diaria el nuevo villano Vulture y, con él, lo más importante de la vida de Peter comenzará a verse amenazado.\";s:10:\"popularity\";d:14.9967;s:11:\"poster_path\";s:32:\"/yJfPC6pjSJ5VOsVyXhx5PXBe0mR.jpg\";s:20:\"production_companies\";a:4:{i:0;a:4:{s:2:\"id\";i:420;s:9:\"logo_path\";s:32:\"/hUzeosd33nzE5MCNsZxCGEKTXaQ.png\";s:4:\"name\";s:14:\"Marvel Studios\";s:14:\"origin_country\";s:2:\"US\";}i:1;a:4:{s:2:\"id\";i:84041;s:9:\"logo_path\";s:32:\"/nw4kyc29QRpNtFbdsBHkRSFavvt.png\";s:4:\"name\";s:15:\"Pascal Pictures\";s:14:\"origin_country\";s:2:\"US\";}i:2;a:4:{s:2:\"id\";i:34034;s:9:\"logo_path\";N;s:4:\"name\";s:13:\"LStar Capital\";s:14:\"origin_country\";s:2:\"US\";}i:3;a:4:{s:2:\"id\";i:5;s:9:\"logo_path\";s:31:\"/71BqEFAF4V3qjjMPCpLuyJFB9A.png\";s:4:\"name\";s:17:\"Columbia Pictures\";s:14:\"origin_country\";s:2:\"US\";}}s:20:\"production_countries\";a:1:{i:0;a:2:{s:10:\"iso_3166_1\";s:2:\"US\";s:4:\"name\";s:24:\"United States of America\";}}s:12:\"release_date\";s:10:\"2017-07-05\";s:7:\"revenue\";i:880166924;s:7:\"runtime\";i:133;s:16:\"spoken_languages\";a:1:{i:0;a:3:{s:12:\"english_name\";s:7:\"English\";s:9:\"iso_639_1\";s:2:\"en\";s:4:\"name\";s:7:\"English\";}}s:6:\"status\";s:8:\"Released\";s:7:\"tagline\";s:41:\"Los deberes pueden esperar. La ciudad no.\";s:5:\"title\";s:22:\"Spider-Man: Homecoming\";s:5:\"video\";b:0;s:12:\"vote_average\";d:7.329;s:10:\"vote_count\";i:22653;}', 1765678547),
('marvelpedia-cache-marvelpedia-cache-pelicula_tt6263850', 'a:26:{s:5:\"adult\";b:0;s:13:\"backdrop_path\";s:32:\"/ufpeVEM64uZHPpzzeiDNIAdaeOD.jpg\";s:21:\"belongs_to_collection\";a:4:{s:2:\"id\";i:448150;s:4:\"name\";s:21:\"Deadpool - Colección\";s:11:\"poster_path\";s:32:\"/6dVSBlh9blLX96tyRDsYtNKpswv.jpg\";s:13:\"backdrop_path\";s:32:\"/dTq7mGyAR5eAydR532feWfjJjzm.jpg\";}s:6:\"budget\";i:200000000;s:6:\"genres\";a:3:{i:0;a:2:{s:2:\"id\";i:28;s:4:\"name\";s:7:\"Acción\";}i:1;a:2:{s:2:\"id\";i:35;s:4:\"name\";s:7:\"Comedia\";}i:2;a:2:{s:2:\"id\";i:878;s:4:\"name\";s:16:\"Ciencia ficción\";}}s:8:\"homepage\";s:17:\"http://marvel.com\";s:2:\"id\";i:533535;s:7:\"imdb_id\";s:9:\"tt6263850\";s:14:\"origin_country\";a:1:{i:0;s:2:\"US\";}s:17:\"original_language\";s:2:\"en\";s:14:\"original_title\";s:20:\"Deadpool & Wolverine\";s:8:\"overview\";s:280:\"Un apático Wade Wilson se afana en la vida civil tras dejar atrás sus días como Deadpool, un mercenario moralmente flexible. Pero cuando su mundo natal se enfrenta a una amenaza existencial, Wade debe volver a vestirse a regañadientes con un Lobezno aún más reacio a ayudar.\";s:10:\"popularity\";d:24.6212;s:11:\"poster_path\";s:32:\"/9TFSqghEHrlBMRR63yTx80Orxva.jpg\";s:20:\"production_companies\";a:6:{i:0;a:4:{s:2:\"id\";i:420;s:9:\"logo_path\";s:32:\"/hUzeosd33nzE5MCNsZxCGEKTXaQ.png\";s:4:\"name\";s:14:\"Marvel Studios\";s:14:\"origin_country\";s:2:\"US\";}i:1;a:4:{s:2:\"id\";i:104228;s:9:\"logo_path\";s:32:\"/hx0C1XcSxGgat8N62GpxoJGTkCk.png\";s:4:\"name\";s:14:\"Maximum Effort\";s:14:\"origin_country\";s:2:\"US\";}i:2;a:4:{s:2:\"id\";i:2575;s:9:\"logo_path\";s:32:\"/9YJrHYlcfHtwtulkFMAies3aFEl.png\";s:4:\"name\";s:21:\"21 Laps Entertainment\";s:14:\"origin_country\";s:2:\"US\";}i:3;a:4:{s:2:\"id\";i:127928;s:9:\"logo_path\";s:32:\"/h0rjX5vjW5r8yEnUBStFarjcLT4.png\";s:4:\"name\";s:20:\"20th Century Studios\";s:14:\"origin_country\";s:2:\"US\";}i:4;a:4:{s:2:\"id\";i:176762;s:9:\"logo_path\";N;s:4:\"name\";s:23:\"Kevin Feige Productions\";s:14:\"origin_country\";s:2:\"US\";}i:5;a:4:{s:2:\"id\";i:22213;s:9:\"logo_path\";s:32:\"/qx9K6bFWJupwde0xQDwOvXkOaL8.png\";s:4:\"name\";s:17:\"TSG Entertainment\";s:14:\"origin_country\";s:2:\"US\";}}s:20:\"production_countries\";a:1:{i:0;a:2:{s:10:\"iso_3166_1\";s:2:\"US\";s:4:\"name\";s:24:\"United States of America\";}}s:12:\"release_date\";s:10:\"2024-07-24\";s:7:\"revenue\";i:1338073645;s:7:\"runtime\";i:127;s:16:\"spoken_languages\";a:1:{i:0;a:3:{s:12:\"english_name\";s:7:\"English\";s:9:\"iso_639_1\";s:2:\"en\";s:4:\"name\";s:7:\"English\";}}s:6:\"status\";s:8:\"Released\";s:7:\"tagline\";s:7:\"Juntos.\";s:5:\"title\";s:18:\"Deadpool y Lobezno\";s:5:\"video\";b:0;s:12:\"vote_average\";d:7.568;s:10:\"vote_count\";i:8003;}', 1765678547),
('marvelpedia-cache-marvelpedia-cache-serie_232125', 'a:32:{s:5:\"adult\";b:0;s:13:\"backdrop_path\";s:32:\"/bAnHzJ6AMhOhnV3C0kTxkpCqpgM.jpg\";s:10:\"created_by\";a:1:{i:0;a:6:{s:2:\"id\";i:1166002;s:9:\"credit_id\";s:24:\"64f83bceffc9de00fe3ef4cf\";s:4:\"name\";s:14:\"Kirsten Lepore\";s:13:\"original_name\";s:14:\"Kirsten Lepore\";s:6:\"gender\";i:1;s:12:\"profile_path\";s:32:\"/rnBSMQ7b1PrICNxOfKAkf1Y0LAe.jpg\";}}s:16:\"episode_run_time\";a:0:{}s:14:\"first_air_date\";s:10:\"2022-08-10\";s:6:\"genres\";a:5:{i:0;a:2:{s:2:\"id\";i:16;s:4:\"name\";s:10:\"Animación\";}i:1;a:2:{s:2:\"id\";i:35;s:4:\"name\";s:7:\"Comedia\";}i:2;a:2:{s:2:\"id\";i:10751;s:4:\"name\";s:7:\"Familia\";}i:3;a:2:{s:2:\"id\";i:10765;s:4:\"name\";s:16:\"Sci-Fi & Fantasy\";}i:4;a:2:{s:2:\"id\";i:10762;s:4:\"name\";s:4:\"Kids\";}}s:8:\"homepage\";s:57:\"https://www.disneyplus.com/series/i-am-groot/3FfVmffm1ijj\";s:2:\"id\";i:232125;s:13:\"in_production\";b:0;s:9:\"languages\";a:1:{i:0;s:2:\"en\";}s:13:\"last_air_date\";s:10:\"2023-09-06\";s:19:\"last_episode_to_air\";a:13:{s:2:\"id\";i:4629243;s:4:\"name\";s:25:\"Groot y la gran profecía\";s:8:\"overview\";s:100:\"Groot va a un antiguo templo de Drez-Lar con una profecía que debe cumplir para salvar el universo.\";s:12:\"vote_average\";d:6.886;s:10:\"vote_count\";i:35;s:8:\"air_date\";s:10:\"2023-09-06\";s:14:\"episode_number\";i:5;s:12:\"episode_type\";s:6:\"finale\";s:15:\"production_code\";s:0:\"\";s:7:\"runtime\";i:6;s:13:\"season_number\";i:2;s:7:\"show_id\";i:232125;s:10:\"still_path\";s:32:\"/o7gblk3nygQh2lEIjCHEdLK3RHA.jpg\";}s:4:\"name\";s:12:\"Yo soy Groot\";s:19:\"next_episode_to_air\";N;s:8:\"networks\";a:1:{i:0;a:4:{s:2:\"id\";i:2739;s:9:\"logo_path\";s:32:\"/1edZOYAfoyZyZ3rklNSiUpXX30Q.png\";s:4:\"name\";s:7:\"Disney+\";s:14:\"origin_country\";s:0:\"\";}}s:18:\"number_of_episodes\";i:10;s:17:\"number_of_seasons\";i:2;s:14:\"origin_country\";a:1:{i:0;s:2:\"US\";}s:17:\"original_language\";s:2:\"en\";s:13:\"original_name\";s:10:\"I Am Groot\";s:8:\"overview\";s:361:\"Una serie de cortometrajes con Groot junto a varios personajes inusuales. Es infantil y molesta a todos los que le rodean: el árbol parlante Groot. Groot es tan tonto y poco razonable que tiene que abandonar la nave espacial del equipo de héroes y acaba aterrizando en un planeta extraño. Allí se encuentra con todo tipo de criaturas: Alienígenas y robots.\";s:10:\"popularity\";d:6.6556;s:11:\"poster_path\";s:32:\"/285ULt4SlLQiYabsFGzuAv9r8ww.jpg\";s:20:\"production_companies\";a:1:{i:0;a:4:{s:2:\"id\";i:420;s:9:\"logo_path\";s:32:\"/hUzeosd33nzE5MCNsZxCGEKTXaQ.png\";s:4:\"name\";s:14:\"Marvel Studios\";s:14:\"origin_country\";s:2:\"US\";}}s:20:\"production_countries\";a:1:{i:0;a:2:{s:10:\"iso_3166_1\";s:2:\"US\";s:4:\"name\";s:24:\"United States of America\";}}s:7:\"seasons\";a:2:{i:0;a:8:{s:8:\"air_date\";s:10:\"2022-08-10\";s:13:\"episode_count\";i:5;s:2:\"id\";i:355645;s:4:\"name\";s:11:\"Temporada 1\";s:8:\"overview\";s:287:\"Mientras crece en una maceta, Baby Groot es atendido por robots. Cuando aparece una grieta en su maceta, los robots reemplazan a Groot con una planta de bonsái. Por celos, Groot ataca la planta y ambos caen al suelo, lo que hace que sus macetas se rompan y Groot dé sus primeros pasos.\";s:11:\"poster_path\";s:32:\"/cMWApUzgeYcHeCxDKLjdybJpYZW.jpg\";s:13:\"season_number\";i:1;s:12:\"vote_average\";d:6.7;}i:1;a:8:{s:8:\"air_date\";s:10:\"2023-09-06\";s:13:\"episode_count\";i:5;s:2:\"id\";i:351746;s:4:\"name\";s:11:\"Temporada 2\";s:8:\"overview\";s:283:\"La traviesa ramita vuelve a las andadas en la segunda temporada de \"Yo soy Groot\". En esta ocasión, Bebé Groot se dedica a explorar el universo y más allá a bordo de las naves de los Guardianes, y se encuentra cara a cara o nariz a nariz con seres y lugares nuevos y pintorescos.\";s:11:\"poster_path\";s:32:\"/285ULt4SlLQiYabsFGzuAv9r8ww.jpg\";s:13:\"season_number\";i:2;s:12:\"vote_average\";d:6.8;}}s:16:\"spoken_languages\";a:1:{i:0;a:3:{s:12:\"english_name\";s:7:\"English\";s:9:\"iso_639_1\";s:2:\"en\";s:4:\"name\";s:7:\"English\";}}s:6:\"status\";s:5:\"Ended\";s:7:\"tagline\";s:35:\"Vuelve un héroe de pocas palabras.\";s:4:\"type\";s:8:\"Scripted\";s:12:\"vote_average\";d:7.1;s:10:\"vote_count\";i:434;}', 1765678547),
('marvelpedia-cache-marvelpedia-cache-serie_61550', 'a:32:{s:5:\"adult\";b:0;s:13:\"backdrop_path\";s:31:\"/MaQ7hbNsiJ30p14UgRdEnXDGMH.jpg\";s:10:\"created_by\";a:2:{i:0;a:6:{s:2:\"id\";i:5552;s:9:\"credit_id\";s:24:\"54a53a9cc3a3680b27011ba0\";s:4:\"name\";s:15:\"Stephen McFeely\";s:13:\"original_name\";s:15:\"Stephen McFeely\";s:6:\"gender\";i:2;s:12:\"profile_path\";s:32:\"/i9B6gFzExPsh5IEjD2nn4ym4lx2.jpg\";}i:1;a:6:{s:2:\"id\";i:5551;s:9:\"credit_id\";s:24:\"54a53a92c3a3682f210145ce\";s:4:\"name\";s:18:\"Christopher Markus\";s:13:\"original_name\";s:18:\"Christopher Markus\";s:6:\"gender\";i:2;s:12:\"profile_path\";s:32:\"/7ooPNp0gnURxYkSSKF2etH7wpZP.jpg\";}}s:16:\"episode_run_time\";a:1:{i:0;i:43;}s:14:\"first_air_date\";s:10:\"2015-01-06\";s:6:\"genres\";a:2:{i:0;a:2:{s:2:\"id\";i:18;s:4:\"name\";s:5:\"Drama\";}i:1;a:2:{s:2:\"id\";i:10765;s:4:\"name\";s:16:\"Sci-Fi & Fantasy\";}}s:8:\"homepage\";s:77:\"https://www.disneyplus.com/browse/entity-e4cbebda-a890-4e99-9a29-40d2162f7d46\";s:2:\"id\";i:61550;s:13:\"in_production\";b:0;s:9:\"languages\";a:1:{i:0;s:2:\"en\";}s:13:\"last_air_date\";s:10:\"2016-03-01\";s:19:\"last_episode_to_air\";a:13:{s:2:\"id\";i:1165525;s:4:\"name\";s:18:\"Final de Hollywood\";s:8:\"overview\";s:120:\"Peggy necesita a Howard Stark para eliminar la Materia Cero y se enfrentan a una misión de la que podrían no regresar.\";s:12:\"vote_average\";d:7;s:10:\"vote_count\";i:44;s:8:\"air_date\";s:10:\"2016-03-01\";s:14:\"episode_number\";i:10;s:12:\"episode_type\";s:6:\"finale\";s:15:\"production_code\";s:3:\"210\";s:7:\"runtime\";i:42;s:13:\"season_number\";i:2;s:7:\"show_id\";i:61550;s:10:\"still_path\";s:31:\"/ylGaVxAjqkjTEygsNTyVJcuL2l.jpg\";}s:4:\"name\";s:13:\"Agente Carter\";s:19:\"next_episode_to_air\";N;s:8:\"networks\";a:1:{i:0;a:4:{s:2:\"id\";i:2;s:9:\"logo_path\";s:32:\"/2uy2ZWcplrSObIyt4x0Y9rkG6qO.png\";s:4:\"name\";s:3:\"ABC\";s:14:\"origin_country\";s:2:\"US\";}}s:18:\"number_of_episodes\";i:18;s:17:\"number_of_seasons\";i:2;s:14:\"origin_country\";a:1:{i:0;s:2:\"US\";}s:17:\"original_language\";s:2:\"en\";s:13:\"original_name\";s:21:\"Marvel\'s Agent Carter\";s:8:\"overview\";s:577:\"1946. La paz ha significado un revés para la agente Carter al verse marginada cuando los hombres vuelven del extranjero. Trabajando como agente secreta en la R.C.E., Peggy se ve haciendo trabajo administrativo cuando preferiría pasar a la acción y luchar contra los malos. Al mismo tiempo, busca la manera de apañárselas como mujer soltera tras haber perdido al amor de su vida, Steve Rogers. Cuando un viejo amigo, Howard Stark, es acusado injustamente de vender sus armas más letales, se pone en contacto con Peggy para encontrar a los responsables y limpiar su nombre.\";s:10:\"popularity\";d:7.2502;s:11:\"poster_path\";s:32:\"/scZsg0rfAyH8ADphzrdhgo5jAXd.jpg\";s:20:\"production_companies\";a:3:{i:0;a:4:{s:2:\"id\";i:19366;s:9:\"logo_path\";s:32:\"/vOH8dyQhLK01pg5fYkgiS31jlFm.png\";s:4:\"name\";s:11:\"ABC Studios\";s:14:\"origin_country\";s:2:\"US\";}i:1;a:4:{s:2:\"id\";i:38679;s:9:\"logo_path\";s:32:\"/v2y3LuLxYtW36hvLa8IDGQk3Oql.png\";s:4:\"name\";s:17:\"Marvel Television\";s:14:\"origin_country\";s:2:\"US\";}i:2;a:4:{s:2:\"id\";i:92828;s:9:\"logo_path\";N;s:4:\"name\";s:17:\"Fazekas & Butters\";s:14:\"origin_country\";s:2:\"US\";}}s:20:\"production_countries\";a:1:{i:0;a:2:{s:10:\"iso_3166_1\";s:2:\"US\";s:4:\"name\";s:24:\"United States of America\";}}s:7:\"seasons\";a:2:{i:0;a:8:{s:8:\"air_date\";s:10:\"2015-01-06\";s:13:\"episode_count\";i:8;s:2:\"id\";i:63213;s:4:\"name\";s:11:\"Temporada 1\";s:8:\"overview\";s:380:\"En 1946, después de acabar la guerra y de perder al Capitán America, la agente Peggy Carter trabaja en la Reserva Científica Estratégica, siendo menospreciada por sus compañeros hombres, mientras secretamente trabaja para Howard Stark en diversas misiones para recuperar sus inventos que han aparecido misteriosamente en el mercado negro, siendo Stark inculpado injustamente.\";s:11:\"poster_path\";s:32:\"/5yFFUXD2PIto8KXEWQt1cJq1juG.jpg\";s:13:\"season_number\";i:1;s:12:\"vote_average\";d:7.7;}i:1;a:8:{s:8:\"air_date\";s:10:\"2016-01-19\";s:13:\"episode_count\";i:10;s:2:\"id\";i:71006;s:4:\"name\";s:11:\"Temporada 2\";s:8:\"overview\";s:580:\"Dedicada a lucha contra las nuevas amenazas que surjan de la nueva era atómica tras la Segunda Guerra Mundial, Peggy tendrá que encontrarse a sí misma en el mundo, una vez inicie su nuevo camino desde Nueva York a Los Ángeles. Pero a pesar de sus nuevas amistades, su nueva casa y, tal vez, haber encontrado el amor, su mundo empezará a tambalearse cuando de primera mano conozca una amenaza surgida de uno de los rincones más siniestros de Hollywood, y de la que jurará hacerse cargo, para proteger a sus hallegados y al mundo entero del peligro que se cierne sobre ellos.\";s:11:\"poster_path\";s:32:\"/hTiMqAEeW0EfRUTCHXlxmB3tA2H.jpg\";s:13:\"season_number\";i:2;s:12:\"vote_average\";d:7.2;}}s:16:\"spoken_languages\";a:1:{i:0;a:3:{s:12:\"english_name\";s:7:\"English\";s:9:\"iso_639_1\";s:2:\"en\";s:4:\"name\";s:7:\"English\";}}s:6:\"status\";s:8:\"Canceled\";s:7:\"tagline\";s:0:\"\";s:4:\"type\";s:8:\"Scripted\";s:12:\"vote_average\";d:7.5;s:10:\"vote_count\";i:1909;}', 1765678547),
('marvelpedia-cache-marvelpedia-cache-serie_84958', 'a:32:{s:5:\"adult\";b:0;s:13:\"backdrop_path\";s:31:\"/N1hWzVPpZ8lIQvQskgdQogxdsc.jpg\";s:10:\"created_by\";a:1:{i:0;a:6:{s:2:\"id\";i:2094567;s:9:\"credit_id\";s:24:\"6001713e7390c0003df730af\";s:4:\"name\";s:15:\"Michael Waldron\";s:13:\"original_name\";s:15:\"Michael Waldron\";s:6:\"gender\";i:2;s:12:\"profile_path\";s:32:\"/5hf8B7h92GhSSch0FVNSfWMyEG2.jpg\";}}s:16:\"episode_run_time\";a:0:{}s:14:\"first_air_date\";s:10:\"2021-06-09\";s:6:\"genres\";a:2:{i:0;a:2:{s:2:\"id\";i:18;s:4:\"name\";s:5:\"Drama\";}i:1;a:2:{s:2:\"id\";i:10765;s:4:\"name\";s:16:\"Sci-Fi & Fantasy\";}}s:8:\"homepage\";s:49:\"https://www.disneyplus.com/series/wp/6pARMvILBGzF\";s:2:\"id\";i:84958;s:13:\"in_production\";b:0;s:9:\"languages\";a:1:{i:0;s:2:\"en\";}s:13:\"last_air_date\";s:10:\"2023-11-09\";s:19:\"last_episode_to_air\";a:13:{s:2:\"id\";i:4447783;s:4:\"name\";s:19:\"Glorioso propósito\";s:8:\"overview\";s:101:\"Loki descubre la esencia del \"glorioso propósito\" al rectificar el pasado en este apasionante final.\";s:12:\"vote_average\";d:8.412;s:10:\"vote_count\";i:102;s:8:\"air_date\";s:10:\"2023-11-09\";s:14:\"episode_number\";i:6;s:12:\"episode_type\";s:6:\"finale\";s:15:\"production_code\";s:0:\"\";s:7:\"runtime\";i:59;s:13:\"season_number\";i:2;s:7:\"show_id\";i:84958;s:10:\"still_path\";s:32:\"/rd64rjCOPoFSYpRlc2wOQXnSoUP.jpg\";}s:4:\"name\";s:4:\"Loki\";s:19:\"next_episode_to_air\";N;s:8:\"networks\";a:1:{i:0;a:4:{s:2:\"id\";i:2739;s:9:\"logo_path\";s:32:\"/1edZOYAfoyZyZ3rklNSiUpXX30Q.png\";s:4:\"name\";s:7:\"Disney+\";s:14:\"origin_country\";s:0:\"\";}}s:18:\"number_of_episodes\";i:12;s:17:\"number_of_seasons\";i:2;s:14:\"origin_country\";a:1:{i:0;s:2:\"US\";}s:17:\"original_language\";s:2:\"en\";s:13:\"original_name\";s:4:\"Loki\";s:8:\"overview\";s:344:\"Loki es llevado ante la misteriosa organización llamada AVT (Autoridad de Variación Temporal) después de los acontecimientos  ocurridos en  \"Avengers: Endgame (2019)\" y  se le da a elegir  enfrentarse a ser borrado de la existencia debido a que es una \"variante de tiempo\" o ayudar a arreglar la línea de tiempo y detener una amenaza mayor.\";s:10:\"popularity\";d:15.7749;s:11:\"poster_path\";s:32:\"/53aonG0QS3ynbYuuwhPtyoOwTDD.jpg\";s:20:\"production_companies\";a:2:{i:0;a:4:{s:2:\"id\";i:420;s:9:\"logo_path\";s:32:\"/hUzeosd33nzE5MCNsZxCGEKTXaQ.png\";s:4:\"name\";s:14:\"Marvel Studios\";s:14:\"origin_country\";s:2:\"US\";}i:1;a:4:{s:2:\"id\";i:176762;s:9:\"logo_path\";N;s:4:\"name\";s:23:\"Kevin Feige Productions\";s:14:\"origin_country\";s:2:\"US\";}}s:20:\"production_countries\";a:1:{i:0;a:2:{s:10:\"iso_3166_1\";s:2:\"US\";s:4:\"name\";s:24:\"United States of America\";}}s:7:\"seasons\";a:2:{i:0;a:8:{s:8:\"air_date\";s:10:\"2021-06-09\";s:13:\"episode_count\";i:6;s:2:\"id\";i:114355;s:4:\"name\";s:11:\"Temporada 1\";s:8:\"overview\";s:775:\"Tras los acontecimientos de Vengadores: Endgame, Loki vuelve a ser el dios de las travesuras. El voluble villano escapa a una nueva línea temporal, por lo que es perseguido por la AVT (Agencia de Variación Temporal).\n\nEl Dios del Engaño debe enfrentarse a los cargos ante la modificación de la línea temporal tras sus usos con el Teseracto. Pero le darán la opción de elegir entre ser eliminado de la realidad o dar caza a una amenaza aún mayor.\n\nEl agente Mobius se trata de un inspector de la AVT que investiga a una persona que se dedica a intentar a acabar con la Sagrada Linea Temporal, pero al encontrarse a Loki, éste decide salvarle de su destino para que se una a él y así intentar atrapar que amenaza todo lo que han construido los Guardianes del Tiempo.\";s:11:\"poster_path\";s:32:\"/xKGQ3FLoXObqQ46RgdxMVJvExjO.jpg\";s:13:\"season_number\";i:1;s:12:\"vote_average\";d:7.8;}i:1;a:8:{s:8:\"air_date\";s:10:\"2023-10-05\";s:13:\"episode_count\";i:6;s:2:\"id\";i:341180;s:4:\"name\";s:11:\"Temporada 2\";s:8:\"overview\";s:385:\"Después de la temporada 1, Loki se encuentra en una batalla por el alma de Time Variance Authority. Junto con Mobius, Hunter B-15 y un equipo de personajes nuevos y recurrentes, Loki navega por un multiverso cada vez más peligroso y en constante expansión en busca de Sylvie, el juez Renslayer, Miss Minutes y la verdad de lo que significa poseer libre albedrío y gloria. objetivo.\";s:11:\"poster_path\";s:32:\"/ksz8uiWczvz1TX28YOYE9WnS9RR.jpg\";s:13:\"season_number\";i:2;s:12:\"vote_average\";d:7.9;}}s:16:\"spoken_languages\";a:1:{i:0;a:3:{s:12:\"english_name\";s:7:\"English\";s:9:\"iso_639_1\";s:2:\"en\";s:4:\"name\";s:7:\"English\";}}s:6:\"status\";s:5:\"Ended\";s:7:\"tagline\";s:30:\"Ha llegado el momento de Loki.\";s:4:\"type\";s:8:\"Scripted\";s:12:\"vote_average\";d:8.171;s:10:\"vote_count\";i:12114;}', 1765678546);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foros`
--

CREATE TABLE `foros` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` enum('abierto','cerrado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'abierto',
  `num_mensajes` int UNSIGNED NOT NULL DEFAULT '0',
  `ultima_actividad` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color_fondo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visibilidad` enum('publico','privado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'publico'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `foros`
--

INSERT INTO `foros` (`id`, `user_id`, `categoria`, `titulo`, `descripcion`, `estado`, `num_mensajes`, `ultima_actividad`, `created_at`, `updated_at`, `color_fondo`, `color_titulo`, `imagen`, `visibilidad`) VALUES
(1, 7, NULL, 'Foro Tenorio el amo', 'Foro para alabar al tenorio', 'abierto', 0, NULL, '2025-12-09 05:02:46', '2025-12-09 05:02:46', '#a78bfa', '#ffffff', 'GMbGJIYxUUocfayji7dsFawdrQmQY2BPlKUGIdRc.jpg', 'publico'),
(2, 8, NULL, 'Vengadores', 'Si si si', 'abierto', 0, NULL, '2025-12-09 11:50:01', '2025-12-09 11:51:02', '#f87171', '#0000ff', 'HV5OPYIWZQyauwvrZ4o9RijiWvcCt65E7wNBGlkf.jpg', 'publico'),
(3, 8, NULL, 'Iro Man el Vengador más duro', 'Iron Man', 'abierto', 0, NULL, '2025-12-10 10:40:32', '2025-12-12 16:18:04', '#f87171', '#0000ff', NULL, 'privado'),
(4, 12, NULL, 'Spiderman Mejor personaje de Marvel', 'En este foro solo se va a comentar sobre el personaje de Spiderman', 'abierto', 0, NULL, '2025-12-10 19:05:35', '2025-12-10 19:11:46', '#f87171', '#ffffff', 'ugKOUfgVLrm9eghiZjKQy7OgiPjYLhhVJzcjAtGn.webp', 'publico'),
(5, 8, NULL, 'Agente Coulson', 'El que une a los Vengadores', 'abierto', 0, NULL, '2025-12-11 17:38:50', '2025-12-13 17:40:38', '#a78bfa', '#00ff00', NULL, 'publico'),
(6, 8, NULL, 'DRAX', 'SORPRENDENTE', 'abierto', 0, NULL, '2025-12-11 17:58:50', '2025-12-13 17:22:15', 'linear-gradient(to right, #6366f1, #8b5cf6)', '#000000', 'pHSUVmyc12IvPykh7SJUb96vT3hImR2V3lDeGxkg.png', 'publico'),
(7, 8, NULL, 'Madame Web', 'Madre de Spiderman?', 'abierto', 0, NULL, '2025-12-11 22:49:44', '2025-12-13 15:57:38', '#3b82f6', '#ffff00', 'sFDo8MKR2Bsg5rzWmRZSPOTgp6OwaCoEptKFQdV8.jpg', 'publico'),
(8, 8, NULL, 'Deadpool', 'Más irónico!!!', 'abierto', 0, NULL, '2025-12-12 17:17:50', '2025-12-12 17:25:23', 'linear-gradient(to right, #facc15, #f43f5e)', '#000000', 'IPvwDnXhOqZvNW95qtRBIvrLuI9kiYIMNX5gzK0h.jpg', 'publico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro_reports`
--

CREATE TABLE `foro_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `foro_id` bigint UNSIGNED NOT NULL,
  `reported_by` bigint UNSIGNED NOT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT '0',
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id` bigint UNSIGNED NOT NULL,
  `foro_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `editado` tinyint(1) NOT NULL DEFAULT '0',
  `editado_en` timestamp NULL DEFAULT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `foro_id`, `user_id`, `contenido`, `parent_id`, `editado`, `editado_en`, `eliminado`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 'Hola hola tenorio es más listo que el migue', NULL, 0, NULL, 0, '2025-12-09 05:06:51', '2025-12-09 05:06:51'),
(2, 1, 7, 'La veldaa la velda', 1, 0, NULL, 0, '2025-12-09 05:07:05', '2025-12-09 05:07:25'),
(3, 2, 8, 'Ole ole y ole', NULL, 0, NULL, 0, '2025-12-09 18:44:12', '2025-12-09 18:44:12'),
(4, 4, 9, 'Tengo mis dudas,  aunque sí mola mucho. 😊', NULL, 0, NULL, 0, '2025-12-11 15:51:52', '2025-12-12 07:38:45'),
(5, 4, 10, 'Esto es mentira', NULL, 0, NULL, 0, '2025-12-11 16:28:25', '2025-12-11 16:28:25'),
(6, 4, 7, 'Es el mejor callarse ya', NULL, 0, NULL, 0, '2025-12-11 17:10:34', '2025-12-11 17:10:34'),
(7, 4, 12, 'No hay duda', 6, 0, NULL, 0, '2025-12-11 17:15:48', '2025-12-11 17:15:48'),
(8, 2, 12, 'ole ole ole ole', 3, 0, NULL, 0, '2025-12-11 17:16:12', '2025-12-11 17:16:12'),
(9, 6, 8, 'Increíble la invisibilidad que consigue con su movimiento leeeeento!!!', NULL, 0, NULL, 0, '2025-12-11 18:02:00', '2025-12-11 22:36:25'),
(10, 7, 8, 'Madame Web es la madre de Spiderman', NULL, 0, NULL, 0, '2025-12-11 22:50:23', '2025-12-11 22:50:23'),
(11, 4, 13, 'Es el mejor y punto', NULL, 0, NULL, 0, '2025-12-12 11:11:17', '2025-12-12 11:11:17'),
(12, 2, 8, 'Tienes toda la razón', 8, 0, NULL, 0, '2025-12-13 15:51:11', '2025-12-13 15:51:11'),
(13, 7, 12, 'Podría ser...', 10, 0, NULL, 0, '2025-12-13 17:18:12', '2025-12-13 17:18:12'),
(14, 5, 8, 'Fan de Capitán América', NULL, 0, NULL, 0, '2025-12-13 17:41:19', '2025-12-13 17:41:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje_reports`
--

CREATE TABLE `mensaje_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `mensaje_id` bigint UNSIGNED NOT NULL,
  `reported_by` bigint UNSIGNED NOT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT '0',
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_18_130711_create_settings_table', 1),
(5, '2025_11_02_171101_create_reviews_table', 1),
(6, '2025_11_12_192646_create_review_reports_table', 1),
(7, '2025_11_22_173146_create_foros_table', 1),
(8, '2025_11_22_173822_create_mensajes_table', 1),
(9, '2025_11_23_103706_create_mensaje_reports_table', 1),
(10, '2025_11_23_180843_add_customization_to_foros_table', 1),
(11, '2025_11_30_092740_add_entity_title_to_reviews_table', 1),
(12, '2025_12_05_092250_create_foro_reports_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` tinyint UNSIGNED NOT NULL COMMENT 'De 1 a 5',
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `type`, `entity_id`, `entity_title`, `rating`, `content`, `created_at`, `updated_at`) VALUES
(3, 3, 'pelicula', 'tt0371746', 'Iron Man', 5, 'Es una pelicula muy espectacular, con un elenco de actores de primer nivel', '2025-12-08 19:38:55', '2025-12-08 19:38:55'),
(5, 5, 'pelicula', '315635', 'Título desconocido', 5, 'HERMANO VAYA PASADA DE PELICULON', '2025-12-08 19:57:05', '2025-12-08 19:57:05'),
(8, 12, 'pelicula', '634649', 'Spider-Man: No Way Home', 5, 'La mejor película hasta el momento de Marvel!!!!', '2025-12-09 17:04:58', '2025-12-09 17:04:58'),
(12, 12, 'serie', '84958', 'Loki', 3, 'Una muy buena serie con muy buenos actores.', '2025-12-09 18:21:40', '2025-12-09 18:21:40'),
(14, 9, 'pelicula', 'tt0800369', 'Thor', 4, '¡¡Qué guapo!!', '2025-12-11 15:50:27', '2025-12-11 15:50:27'),
(17, 10, 'serie', '138501', 'Agatha, ¿quién si no?', 5, 'genial, esplendorosa, maravillosa', '2025-12-11 16:41:02', '2025-12-11 16:41:02'),
(18, 10, 'pelicula', 'tt2015381', 'Guardianes de la galaxia', 4, 'está guay', '2025-12-11 16:42:34', '2025-12-11 16:42:34'),
(19, 12, 'serie', '92783', 'She-Hulk: abogada Hulka', 1, 'La peor serie de marvel hasta el momento', '2025-12-11 17:09:25', '2025-12-11 17:09:25'),
(21, 8, 'pelicula', 'tt4154756', 'Vengadores: Infinity War', 5, 'Está sí que está entretenida', '2025-12-11 22:35:17', '2025-12-11 22:35:17'),
(22, 12, 'pelicula', 'tt20969586', 'Thunderbolts*', 3, 'Buena película pero se hace un poco larga', '2025-12-12 09:58:34', '2025-12-12 09:58:34'),
(23, 12, 'pelicula', 'tt2250912', 'Spider-Man: Homecoming', 4, 'Buena película para introducir a Tom Holland como nuevo Spiderman', '2025-12-12 10:01:30', '2025-12-12 10:01:30'),
(24, 13, 'pelicula', 'tt0371746', 'Iron Man', 5, 'increíble, que vuelva este marvel', '2025-12-12 11:05:13', '2025-12-12 11:05:13'),
(25, 13, 'serie', '84958', 'Loki', 5, 'la mejor serie de marvel sin duda', '2025-12-12 11:09:50', '2025-12-12 11:09:50'),
(26, 13, 'serie', '61550', 'Agente Carter', 4, 'Infravaloradísima, es una serie chulísima y ella de las mejores mujeres de marvel', '2025-12-12 11:12:40', '2025-12-12 11:12:40'),
(29, 12, 'serie', '232125', 'Yo soy Groot', 4, 'El mejor personaje con gran diálogo <3', '2025-12-13 17:05:54', '2025-12-13 17:13:43'),
(30, 8, 'serie', '232125', 'Yo soy Groot', 4, 'Siempre que habla no se equivoca!!!', '2025-12-13 17:13:46', '2025-12-13 17:13:46'),
(31, 9, 'pelicula', 'tt6263850', 'Deadpool y Lobezno', 4, 'Oh... Lobezno me encanta 💖', '2025-12-13 18:09:33', '2025-12-13 18:09:33'),
(32, 9, 'serie', '84958', 'Loki', 4, 'Aún no la he visto, pero lo haré pronto', '2025-12-13 18:12:25', '2025-12-13 18:12:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review_reports`
--

CREATE TABLE `review_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `review_id` bigint UNSIGNED NOT NULL,
  `reported_by` bigint UNSIGNED DEFAULT NULL,
  `resolved` tinyint(1) NOT NULL DEFAULT '0',
  `deadline` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1T3cMAsogBgtRgxLP98T0WkwaS3eecn8oi4gtA9F', NULL, '66.249.93.99', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoic1lqZlE5bUV5Unh1bzVZaGlyMlNFNjlMTFpkSDY3UnFBMjlhS3VKRCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1MzoiaHR0cHM6Ly9tYXJ2ZWxwZWRpYS5ydWl4Lmllc3J1aXpnaWpvbi5lcy9mb3Jvcy81L2VkaXQiO31zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czo1MzoiaHR0cHM6Ly9tYXJ2ZWxwZWRpYS5ydWl4Lmllc3J1aXpnaWpvbi5lcy9mb3Jvcy81L2VkaXQiO3M6NToicm91dGUiO3M6MTA6ImZvcm9zLmVkaXQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1765651201),
('3KeHqYWJQ3ITBEiCzWNqaazTieHfU2Ptwmim95xt', NULL, '92.57.173.93', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGwyZjVsdVRuRkpQZFFsOHp6WWNEbDFPUldpU0tTREZjSEZnVEw1SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTc6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvc2VyaWUvdHQxNTU3MTczMiI7czo1OiJyb3V0ZSI7czoxMDoic2VyaWUuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765652213),
('7JxOErIcqtYJLaFWVrFuj5uEVvs5ET2enwIma2QH', 9, '92.57.173.93', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOGdOeEJ2M3dGUkVxeDU4ZFhobWtFRVNPaGNVUmI0cjQ4amZzeWZkVyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvYXl1ZGEiO3M6NToicm91dGUiO3M6NToiYXl1ZGEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo5O30=', 1765653376),
('AU8XzF4D4IoS7AYDJKsqUMSyo4PELVYCqL2Ncxxe', NULL, '66.249.88.3', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic3RtSVJWRXZxcmlwdURYY1dUSGFIRmRoMTZUUzEyMlZ6QUx5VjJUQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvZm9yb3MvNSI7czo1OiJyb3V0ZSI7czoxMDoiZm9yb3Muc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765651007),
('ExfTnSEZwJJ3WqDZ2DvNsBw0f6ENhApVBqOybQPr', NULL, '92.57.173.93', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMERYdXVmQnZPWWttdlByc2ZlYUpqb3ZHN0NkOWtqM3pqMjBmTmMyTSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTc6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvc2VyaWUvdHQxNTU3MTczMiI7czo1OiJyb3V0ZSI7czoxMDoic2VyaWUuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765652401),
('f2RlZtc8HGMiSf1V0PSPpNOXP7hYWh5JnOmljoBR', NULL, '66.249.93.99', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWUydnNiY2NIUTFUQ0V6Y3F6UGg1TG1nYVA2Q0NEYUJ0YjNMRWVIQiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvcGVsaWN1bGEvdHQ0MTU0NzU2IjtzOjU6InJvdXRlIjtzOjEzOiJwZWxpY3VsYS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765656881),
('HiaMgvskMVi6FT0LSf2Jxqj2QsuuMbBoI45VoamS', 8, '85.217.147.86', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZUFseEROM3J3SGtvOE5IVlRWc1hwbHF4TkdVV01tRVkyMTViVXN3VSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvcmVzZW5hcyI7czo1OiJyb3V0ZSI7czo3OiJyZXNlbmFzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6ODt9', 1765658226),
('nS9pm0ey52WBwhbP6ARQua2VKW5xuI3TsR1JXGVQ', NULL, '92.57.173.93', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUDVveFVHc2hPT255UVFXR0ZnclNHTHJFUmhzR0N6M3dCMnFlYUw2ZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTc6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvc2VyaWUvdHQxNTU3MTczMiI7czo1OiJyb3V0ZSI7czoxMDoic2VyaWUuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765652381),
('obra99Um2DKqAGtRms8GObwuWnBei72GdIDRYX7h', 1, '85.217.147.86', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQjJhVURZYnlvaXRiNzBIQ2VDMHNROWlnWndSaXFLT1ZXQ0pqRG92byI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NjE6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvYWRtaW4vbWFuYWdlLWNvbnRlbnQiO3M6NToicm91dGUiO3M6MjA6ImFkbWluLm1hbmFnZS1jb250ZW50Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1765658169),
('rli0CvPMghWjVb5WFKXIrjJZcgleJuIV4HeGPjGI', NULL, '92.57.173.93', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/29.0 Chrome/136.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZERuS0xvN1JtR2hYN0JJUnhsYnp6NXZjangzamphZXJzRExxa09tbCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTc6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvc2VyaWUvdHQxNTU3MTczMiI7czo1OiJyb3V0ZSI7czoxMDoic2VyaWUuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765652470),
('rVvAVonSuIIkEUwkx9RoTfERD48w8ODw3siEcy8h', NULL, '66.249.93.99', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZ0hQcnFtTUZBRnRrOExRMlVrb0JMcHJEUXRtekVZdW82VVRwaHVlTiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0ODoiaHR0cHM6Ly9tYXJ2ZWxwZWRpYS5ydWl4Lmllc3J1aXpnaWpvbi5lcy91c2Vycy8xIjt9czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvdXNlcnMvMSI7czo1OiJyb3V0ZSI7czoxMDoidXNlcnMuc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765650871),
('SKSpY2outTqYC64SAQHFSchX4VonSgAttwMz6xf3', 12, '85.217.147.86', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibnFiT1JoTmdHMGF2N2FBNHRGVHhTWjk0cjluN1UwYWx6UHB5a2QxOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTY6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvcmVzZW5hcy8yOS9qc29uIjtzOjU6InJvdXRlIjtzOjEyOiJyZXNlbmFzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxMjt9', 1765657009),
('Ss0BAklLUNGqQpfpuuECnswL21rnXjVoYewyAyHQ', NULL, '92.57.173.93', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRDAycXJ0VnJEUTBrZ3AzcGNhcDJKemI3U01vM2F3QmZOZGxuandqSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1765652556),
('SzJsIjToGq9pFO7Zj6pnMxCYYygIsA0pQm4szK8m', NULL, '185.234.185.154', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSE9CYk0zM3pDWXpRSmR3NTNCWmhMTG5aVmtRNkRYVFdhNnlWdjA0SyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDA6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMiO3M6NToicm91dGUiO3M6NjoiaW5pY2lvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765652269),
('u4jwiwv4S3lMRGHotR3pMmw70gVM3s8vIRn9poAQ', NULL, '66.249.88.2', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSklPd2tWWlM5b1F3Smd3SW1jM1pTUzBLUzlGNGcwcXB5S05OekxpMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvZm9yb3MvNSI7czo1OiJyb3V0ZSI7czoxMDoiZm9yb3Muc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765651007),
('VEDkjcvTVNI8OOpa4p8PwEEz02uGAN5HRl7n79z3', 12, '85.217.147.86', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZVE1bDVkcTFMYWZIUG5zUm9jRmNscFFJQzB3eWt5NVd2ZlREZFVxcyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjU2OiJodHRwczovL21hcnZlbHBlZGlhLnJ1aXguaWVzcnVpemdpam9uLmVzL3Jlc2VuYXMvMjkvanNvbiI7czo1OiJyb3V0ZSI7czoxMjoicmVzZW5hcy5zaG93Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTI7fQ==', 1765656964),
('vmq8lTwTbEKgO2QqROkrI2pQ73rtbYO2Df59iDPX', NULL, '66.249.93.97', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienpoOXBrbDJrRGlCRGVxbXZPMFBUUEZHaThLSGtoOFVpRG11SVY0SyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvcGVsaWN1bGEvdHQ0MTU0NzU2IjtzOjU6InJvdXRlIjtzOjEzOiJwZWxpY3VsYS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765656880),
('vrUNJ3tWmY22YLUEkKyoi1p051mldZXzhOMzAAe1', NULL, '66.249.93.98', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlZmMHMycmVjYXFKdHc2ZjlkM042dDJGWlRXejJDMWdiOHU2aGxHTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTk6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvcGVsaWN1bGEvdHQ0MTU0NzU2IjtzOjU6InJvdXRlIjtzOjEzOiJwZWxpY3VsYS5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765656881),
('WFDSRrWBqBJrP6i2wKE4kdliMOnOiJJjquszy37A', NULL, '66.249.93.97', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkpHa21LQUhJSDR6eDdQMW5HdDcydmxZWnRpTWZPbE0weTltam1IOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1765650871),
('WmeFspmOvQFHsIXqADdp17KRzaDqgg631aVc1YaX', NULL, '66.249.93.98', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiV0pHQ3h4SDQ4WUo5SWxTa29XeFpZTklOR0NxV2w1bDdXTnBJWEtKZSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDY6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvbG9naW4iO3M6NToicm91dGUiO3M6NToibG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1765651201),
('wP9yNjF7cYdZ6uH9OIGcSPOBM1IVpmTyDDv6X9s6', NULL, '66.249.93.98', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYlQ5R3ZBUmlrUVIzNUtoRzJyZnBuaXh2cE1sUm9UaFpseXdHZ1JiMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDg6Imh0dHBzOi8vbWFydmVscGVkaWEucnVpeC5pZXNydWl6Z2lqb24uZXMvZm9yb3MvNSI7czo1OiJyb3V0ZSI7czoxMDoiZm9yb3Muc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765651006);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favorito_personaje` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favorito_comic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `banner_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default',
  `nivel` int NOT NULL DEFAULT '1',
  `puntos` int NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar_url`, `nickname`, `favorito_personaje`, `favorito_comic`, `pais`, `fecha_nacimiento`, `banner_url`, `theme`, `nivel`, `puntos`, `remember_token`, `role`, `bio`, `twitter`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'soportemarvelpedia@gmail.com', '2025-12-08 18:56:25', '$2y$12$XvTh9EAxsuLHz6LLi/WXgOAeLXo5/..GHtnEVxwBuVO6ez4TeidcO', 'avatars/9gwtfqa8hJ00EHGVAjK2h5FAcoXg4pZaCIL3TBOb.png', 'admin', 'Spider-Man', NULL, 'España', '2004-04-02', NULL, 'default', 1, 0, NULL, 'admin', 'Soy la Administradora y me encargo de que esta página no sea un desastre', 'https://x.com/elenaro0204?t=SDcF4EMqNG1hOGSuUYLO_A&s=09', 'https://www.instagram.com/elenaro0204/?igsh=MnVzbzE3ZmEzeW5x#', '2025-12-08 18:56:03', '2025-12-12 07:10:47'),
(2, 'Migue', 'migue@test.com', NULL, '$2y$12$/yEHN.XqRe2u6tx3IpdaPetqOWFZNOg103ug3yzRUkhGLayygRrRO', NULL, 'migue', NULL, NULL, 'España', '2003-12-12', NULL, 'default', 1, 0, 'Ia6mUbxhNLqovn5PMwQmt9U9QUoKsSXmEwKSeXHw85lxhSoRSMp79BPwtbMJ', 'user', NULL, NULL, NULL, '2025-12-08 19:33:19', '2025-12-12 12:30:38'),
(3, 'Fran', 'fran@ceidumbo.es', '2025-12-08 19:35:16', '$2y$12$VZAE8fLFVxFB6VZv7wN/G.HtzQeLPyIQkocs1DpYxSTunUgybtT3q', 'avatars/J9Qqnq5hW7rrg9UyxCxr8lA3lasKpL8eaxuZV3r6.jpg', 'Fran', NULL, NULL, 'España', '1973-02-17', NULL, 'default', 1, 0, NULL, 'user', NULL, NULL, NULL, '2025-12-08 19:34:50', '2025-12-12 15:36:59'),
(4, 'Marina Vázquez Medinilla', 'pruebamarina@gmail.com', NULL, '$2y$12$cMKhE83WpTG58hzhLjTkYu.fkRMgY8Jz6lgaAwLJoqtlPbaD/jpRO', NULL, 'marina', NULL, NULL, 'España', '1994-11-20', NULL, 'default', 1, 0, NULL, 'user', NULL, NULL, NULL, '2025-12-08 19:52:24', '2025-12-12 12:32:35'),
(5, 'Carmen', 'carrmeenmoreeno@gmail.com', '2025-12-08 19:54:19', '$2y$12$YdlFCvY0qgxAX5FCyN3wUu1.CQkgHFv04PT50GgDLvBiyAAqW5SfO', 'avatars/7FolMeveDEX4Ell7kFhCRwq7hHPKq08T8ncNCweR.jpg', 'caarmen', NULL, NULL, 'España', '2004-02-06', NULL, 'default', 1, 0, NULL, 'user', NULL, NULL, NULL, '2025-12-08 19:53:52', '2025-12-12 15:38:03'),
(7, 'Juan Carlos Tenorio Pintor', 'sweetpako2001@gmail.com', '2025-12-09 04:49:28', '$2y$12$0fctMEZumHlYfx1MCtnM9ODiWddXHO5HBKlxhdJobDleOUOEKVlU6', 'avatars/5KnJuJLiWfaMezHHOSHFzftv2oFDUlh3YfFSkqrq.jpg', 'Tenorio', NULL, NULL, 'España', '2003-11-23', NULL, 'default', 1, 0, NULL, 'user', NULL, NULL, NULL, '2025-12-09 04:49:14', '2025-12-12 15:38:21'),
(8, 'Juan M.', 'johnrelly@hotmail.com', '2025-12-09 11:34:56', '$2y$12$55RzboR1syxBVuSIRdYBc.15kIPEXtOtp1qEmEm.N92WohzXDub8a', 'avatars/gIvlFRRnNv49AMnATTu3QcZfIK4naPNdiF01OWdJ.jpg', 'Relly', NULL, NULL, 'España', '1968-12-27', NULL, 'default', 1, 0, '0xWsU7dh38RPWvL2mCG5M5wvxlDEOeceicGxa6lZhkgUZE0xLO3tmpdh2al1', 'user', NULL, NULL, NULL, '2025-12-09 11:34:11', '2025-12-12 16:15:42'),
(9, 'YohannaGelo', 'yohannagelo@gmail.com', '2025-12-10 05:38:47', '$2y$12$h3intsjbmnI/oOZYJRzg0OfuJJoXgQn2SZjqt2PeMxfAdiWxem53u', 'avatars/GTtZMpXqFRUOtdHgLoXpq7Kl6SeeUenIeOCIkWKS.jpg', 'Yuurey', 'Thor', NULL, 'España', NULL, NULL, 'default', 1, 0, NULL, 'user', NULL, NULL, 'https://www.instagram.com/yohannagelo?igsh=MXk4Z2QxNThxY2F0', '2025-12-10 05:38:08', '2025-12-13 18:15:06'),
(10, 'Azahara', 'mariaazahara.parrales-cuevas@iesruizgijon.com', '2025-12-11 16:20:41', '$2y$12$9dAlYvt.r7E9iwceGFF/6eLoTWaEbx.del9sipxMoYb9pYtjtruyy', 'avatars/GhyamLjd69CFlaEclkflkcPU6J1EuGmJ4ZijTEBN.jpg', 'Aza', 'Yelena Belova', NULL, NULL, NULL, NULL, 'default', 1, 0, NULL, 'user', 'vete a saber.', NULL, NULL, '2025-12-11 16:20:20', '2025-12-12 15:39:33'),
(11, 'Marina', 'marinazabalatapia@gmail.com', '2025-12-11 20:36:11', '$2y$12$i5eg7AKaVdBnnOMbXnz/7.vME2XNsjFbmSS07iXK0nk6yFV9hpUJG', 'avatars/amt9KQm4u2PS0ugmQQgiCBHY1qGXNxFS0nIODQCx.png', 'Wapetona', NULL, NULL, 'España', '2004-07-31', NULL, 'default', 1, 0, NULL, 'user', NULL, NULL, NULL, '2025-12-11 20:35:49', '2025-12-12 15:43:59'),
(12, 'Elena', 'elenaro2004@hotmail.com', '2025-12-12 09:55:05', '$2y$12$XHHeErtPbsQ.Rpr5gFkGyu9mnQBsP4QmYOkmVeCa5XxAxk7kRAm3.', 'avatars/To2Z3evybybQoG40jqQjD2GV7zdN8V1dppkDSMNc.jpg', 'elenaro0204', 'Spider-Man', NULL, 'España', '2004-04-02', NULL, 'default', 1, 0, NULL, 'user', 'Gran fan de Marvel y de esta maravillosa página.', NULL, NULL, '2025-12-12 09:54:27', '2025-12-12 09:59:52'),
(13, 'Lola', 'lolaleomartos@gmail.com', '2025-12-12 11:03:34', '$2y$12$Zrzkf9Rjpv6yl/H6knvWie4GFQXObzxoLgL5CnxgThFBNVXoekngC', 'avatars/EydskMtxbTV629omxw9TOBL7rI8JchCGRY9bSwJT.jpg', 'lola', 'Spiderman', NULL, 'España', '2004-05-10', NULL, 'default', 1, 0, NULL, 'user', NULL, NULL, NULL, '2025-12-12 11:02:54', '2025-12-12 15:40:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `foros`
--
ALTER TABLE `foros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foros_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `foro_reports`
--
ALTER TABLE `foro_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foro_reports_foro_id_foreign` (`foro_id`),
  ADD KEY `foro_reports_reported_by_foreign` (`reported_by`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mensajes_foro_id_foreign` (`foro_id`),
  ADD KEY `mensajes_user_id_foreign` (`user_id`),
  ADD KEY `mensajes_parent_id_foreign` (`parent_id`);

--
-- Indices de la tabla `mensaje_reports`
--
ALTER TABLE `mensaje_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mensaje_reports_mensaje_id_foreign` (`mensaje_id`),
  ADD KEY `mensaje_reports_reported_by_foreign` (`reported_by`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `review_reports`
--
ALTER TABLE `review_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `review_reports_review_id_foreign` (`review_id`),
  ADD KEY `review_reports_reported_by_foreign` (`reported_by`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foros`
--
ALTER TABLE `foros`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `foro_reports`
--
ALTER TABLE `foro_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `mensaje_reports`
--
ALTER TABLE `mensaje_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `review_reports`
--
ALTER TABLE `review_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `foros`
--
ALTER TABLE `foros`
  ADD CONSTRAINT `foros_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `foro_reports`
--
ALTER TABLE `foro_reports`
  ADD CONSTRAINT `foro_reports_foro_id_foreign` FOREIGN KEY (`foro_id`) REFERENCES `foros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `foro_reports_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_foro_id_foreign` FOREIGN KEY (`foro_id`) REFERENCES `foros` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `mensajes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensajes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mensaje_reports`
--
ALTER TABLE `mensaje_reports`
  ADD CONSTRAINT `mensaje_reports_mensaje_id_foreign` FOREIGN KEY (`mensaje_id`) REFERENCES `mensajes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mensaje_reports_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `review_reports`
--
ALTER TABLE `review_reports`
  ADD CONSTRAINT `review_reports_reported_by_foreign` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_reports_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

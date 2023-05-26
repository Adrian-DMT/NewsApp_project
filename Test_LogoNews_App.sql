-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2023 at 12:11 PM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Test_LogoNews_App`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_news` int NOT NULL,
  `id_user` int NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `id_news`, `id_user`, `created_date`, `updated_at`) VALUES
(3, 'Comment number 3 ...', 24535, 2, '2023-03-01 10:32:43', '2023-03-17 13:20:51'),
(4, 'Comment number 4 ...', 24535, 1, '2023-03-01 10:32:43', '2023-03-17 13:20:51'),
(5, 'Ad, recusandae. Fugit, aspernatur. Temporibus, est! Molestias totam at rerum dolorem ipsum molestiae hic, omnis sapiente aliquid perferendis suscipit sit dolores!', 24535, 2, '2023-03-01 10:32:43', '2023-03-17 13:20:51'),
(26, 'Some Other comment', 24535, 1, '2023-03-01 10:32:43', '2023-03-17 13:20:51'),
(39, 'A comment Test Name', 24535, 1, '2023-03-20 09:30:37', '2023-03-20 09:30:37'),
(41, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores quis praesentium assumenda obcaecati neque non eius fugit, distinctio at ex ....', 24535, 1, '2023-03-20 09:33:16', '2023-03-20 09:33:16'),
(42, 'Test comment from Doe ...\r\n', 24535, 2, '2023-03-20 09:41:51', '2023-03-20 09:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike_comments`
--

CREATE TABLE `like_dislike_comments` (
  `thumbs_up` int NOT NULL,
  `thumbs_down` int NOT NULL,
  `id_user` int NOT NULL,
  `comment_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `like_dislike_comments`
--

INSERT INTO `like_dislike_comments` (`thumbs_up`, `thumbs_down`, `id_user`, `comment_id`) VALUES
(1, 0, 1, 4),
(0, 1, 1, 26),
(1, 0, 1, 41),
(1, 0, 1, 42),
(1, 0, 2, 42);

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike_news`
--

CREATE TABLE `like_dislike_news` (
  `thumbs_up` tinyint(1) DEFAULT NULL,
  `thumbs_down` tinyint(1) DEFAULT NULL,
  `id_news` int NOT NULL,
  `id_user` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `like_dislike_news`
--

INSERT INTO `like_dislike_news` (`thumbs_up`, `thumbs_down`, `id_news`, `id_user`) VALUES
(1, 0, 24535, 1),
(1, 0, 24535, 2),
(0, 1, 24535, 28),
(1, 0, 24542, 1),
(1, 0, 24542, 2);

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike_replays`
--

CREATE TABLE `like_dislike_replays` (
  `thumbs_up` tinyint(1) NOT NULL,
  `thumbs_down` tinyint(1) NOT NULL,
  `id_user` int NOT NULL,
  `replay_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `like_dislike_replays`
--

INSERT INTO `like_dislike_replays` (`thumbs_up`, `thumbs_down`, `id_user`, `replay_id`) VALUES
(1, 0, 1, 39),
(0, 1, 1, 40);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `author` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(1410) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `urlToImage` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publishedAt` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `author`, `title`, `description`, `url`, `urlToImage`, `publishedAt`, `content`, `created_at`) VALUES
(24525, '', 'March Madness winners and losers: Alabama soars into Sweet 16; red-hot Duke goes down vs. Tennessee - CBS Sports', 'Here\'s who seized the moment and who stumbled on the first day of the second round of the NCAA Tournament', 'https://www.cbssports.com/college-basketball/news/march-madness-winners-and-losers-alabama-soars-into-sweet-16-red-hot-duke-goes-down-vs-tennessee/', 'https://sportshub.cbsistatic.com/i/r/2023/03/19/31b5ce7e-0e0a-42b8-9df2-f73924102825/thumbnail/1200x675/f8279bb38a0bbff938bf5039daf09b52/usatsi-20267246-1.jpg', '2023-03-19T05:24:06Z', 'March Madness went ahead and went, well, mad on Saturday in the first day of Round 2 action to kickstart the weekend. One day after No. 1 seed Purdue got booted to the curb by No. 16 seed Fairleigh D… [+8073 chars]', '2023-03-20 09:26:56'),
(24526, 'Ken Martin', 'Warren Buffett talks banking crisis with Biden team - Fox Business', 'Warren Buffett has held discussions with the Biden administration to help in in the current financial crisis.', 'https://www.foxbusiness.com/business-leaders/warren-buffett-talks-banking-crisis-biden-team', 'https://a57.foxnews.com/static.foxbusiness.com/foxbusiness.com/content/uploads/2021/12/0/0/buffettwarren.jpg?ve=1&tl=1', '2023-03-19T03:59:26Z', 'The Oracle of Omaha has been in touch with Biden administration officials to lend his assistance during the current banking crisis.\r\nBillionaire investor Warren Buffett has had multiple conversations… [+2196 chars]', '2023-03-20 09:26:56'),
(24527, 'Nick Paton Walsh, Allegra Goodwin', 'NATO fighter jets intercept Russian aircraft near Estonian airspace - CNN', 'British and German fighter jets intercepted a Russian aircraft flying close to Estonian airspace Friday, according to a statement from the UK\'s Royal Air Force (RAF).', 'https://www.cnn.com/2023/03/18/world/nato-fighter-jets-russian-interception-estonia-intl-hnk/index.html', 'https://media.cnn.com/api/v1/images/stellar/prod/230318211354-tupolev-134-file.jpg?c=16x9&q=w_800,c_fill', '2023-03-19T03:40:00Z', 'British and German fighter jets intercepted a Russian aircraft flying close to Estonian airspace Friday, according to a statement from the UKs Royal Air Force (RAF).\r\nIt was the second such encounter… [+2005 chars]', '2023-03-20 09:26:56'),
(24528, 'David Begnaud', 'Chowchilla bus kidnapping survivor Jodi Heffington\'s lifelong fight to keep her captors behind bars - CBS News', 'Twenty-six children abducted by masked gunmen and buried alive in a truck trailer — survivors share their emotional, personal stories of bravery and helping each other survive the unknown.', 'https://www.cbsnews.com/news/chowchilla-bus-kidnapping-jodi-heffington-survivor-lifelong-fight-to-keep-captors-behind-bars/', 'https://assets2.cbsnewsstatic.com/hub/i/r/2023/03/19/a265eb7d-9e3b-4c0a-b200-4c74d00cc1c7/thumbnail/1200x630/723ab103322ebb1fb3f0d21a9f78448f/chowchilla-heffington4.jpg', '2023-03-19T03:24:00Z', 'Produced by Chris Young Ritzen, George Osterkamp, Mead Stone and Gary Winter\r\nIn August 2022, after 46 years, the last of three men convicted of kidnapping 26 children and their bus driver was parole… [+34065 chars]', '2023-03-20 09:26:56'),
(24529, 'Maija Ehlinger, Marlon Sorto, Abel Alvarado, Heather Chen', 'At least 16 dead after magnitude 6.8 earthquake shakes Ecuador - CNN', 'At least 16 people died after a magnitude 6.8 earthquake struck southern Ecuador on Saturday afternoon, according to government officials.', 'https://www.cnn.com/2023/03/18/americas/ecuador-earthquake/index.html', 'https://media.cnn.com/api/v1/images/stellar/prod/230318195913-02-ecuador-earthquake-031823.jpg?c=16x9&q=w_800,c_fill', '2023-03-19T03:20:00Z', 'At least 16people diedafter a magnitude6.8 earthquake struck southern Ecuador on Saturday afternoon, according to government officials. \r\nThe earthquake struck near the southern town of Baláo and was… [+1568 chars]', '2023-03-20 09:26:56'),
(24530, 'Matt Grobar', 'Stephanie Reddick Pays Tribute To Late Husband Lance Reddick: “Taken From Us Far Too Soon” - Deadline', 'Lance Reddick’s widow, Stephanie Reddick, took to social media earlier today to pay tribute both to her late actor husband — who died of natural causes on Friday, aged 60 — and to all those w…', 'https://deadline.com/2023/03/lance-reddick-widow-stephanie-reddick-pays-tribute-to-late-actor-1235304024/', 'https://deadline.com/wp-content/uploads/2023/03/GettyImages-1176058573-e1679192990652.jpg?w=1024', '2023-03-19T02:45:00Z', 'Lance Reddick’s widow, Stephanie Reddick, took to social media earlier today to pay tribute both to her late actor husband — who died of natural causes on Friday, aged 60 — and to all those who loved… [+2472 chars]', '2023-03-20 09:26:56'),
(24531, NULL, 'Mysterious Streaks of Light Seen in the Sky Over Northern California - NBC Bay Area', NULL, 'https://www.youtube.com/watch?v=xB9hgcoHLEc', NULL, '2023-03-19T02:38:13Z', 'Your browser isnt supported anymore. Update it to get the best YouTube experience and our latest features. Learn more\r\nRemind me later', '2023-03-20 09:26:56'),
(24532, 'https://www.facebook.com/kslcom/', '\'Jurassic Park\' actor Sam Neill reveals cancer diagnosis - KSL.com', 'In his forthcoming memoir, actor Sam Neill, best known for his work in the', 'https://www.ksl.com/article/50602819/jurassic-park-actor-sam-neill-reveals-cancer-diagnosis', 'https://img.ksl.com/slc/2920/292077/29207775.jpg?filter=kslv2/responsive_story_lg', '2023-03-19T02:29:33Z', 'Estimated read time: 1-2\r\n minutes\r\nATLANTA In his forthcoming memoir, actor Sam Neill, best known for his work in the \"Jurassic Park\" franchise films, reveals he recently battled stage III blood can… [+1111 chars]', '2023-03-20 09:26:56'),
(24533, 'Kyle Bonagura', 'Princeton takes out Missouri, latest 15-seed to make Sweet 16 - ESPN', 'No. 15 seed Princeton controlled Saturday\'s game against 7-seed Missouri nearly the entire way and won 78-63 to advance to the Sweet 16.', 'https://www.espn.com/mens-college-basketball/story/_/id/35892612/princeton-takes-missouri-latest-15-seed-make-sweet-16', 'https://a2.espncdn.com/combiner/i?img=%2Fphoto%2F2023%2F0319%2Fr1146762_1296x729_16%2D9.jpg', '2023-03-19T02:28:21Z', 'SACRAMENTO, Calif. -- No. 15-seeded Princeton advanced to the Sweet 16 with 78-63 win against No. 7 Missouri on Saturday, becoming the second Ivy League team to do so since the men\'s NCAA basketball … [+2670 chars]', '2023-03-20 09:26:56'),
(24534, NULL, 'Leon Edwards: Colby Covington Title Shot \'Doesn\'t Make Sense\' - MMA Fighting - MMAFightingonSBN', 'After his #ufc 286 title defense, Leon Edwards discusses his performance against Kamaru Usman, who should be next, if he will ever fight Usman again, and mor...', 'https://www.youtube.com/watch?v=V_CVpI3bIMg', 'https://i.ytimg.com/vi/V_CVpI3bIMg/maxresdefault.jpg', '2023-03-19T02:07:39Z', NULL, '2023-03-20 09:26:56'),
(24535, 'Jeff Eisenberg', 'March Madness 2023: Houston endures despite setbacks, now halfway to hometown Final Four - Yahoo Sports', 'It didn’t matter that Houston had to play a virtual road game with injuries. The Cougars refused to become the latest upset victim in this year’s...', 'https://sports.yahoo.com/march-madness-2023-houston-endures-despite-setbacks-now-halfway-to-hometown-final-four-014838767.html', 'https://s.yimg.com/ny/api/res/1.2/vLZMG8SXues2IlYefxhJRQ--/YXBwaWQ9aGlnaGxhbmRlcjt3PTEyMDA7aD03NTU-/https://s.yimg.com/os/creatr-uploaded-images/2023-03/5d88e1d0-c5f3-11ed-9fbd-067a96a01733', '2023-03-19T01:48:00Z', 'It didnt matter that Houston had to play a virtual road game. Or that two of the Cougars best players were hampered by injuries and foul trouble.\r\nKelvin Sampsons tough, tenacious team refused to bec… [+2900 chars]', '2023-03-20 09:26:56'),
(24536, 'https://www.facebook.com/bbcnews', 'Credit Suisse bank: UBS said to be in takeover talks with troubled rival - BBC', 'Emergency talks are reported in Zurich as regulators seek a deal for Credit Suisse before Monday.', 'https://www.bbc.com/news/business-65004605', 'https://ichef.bbci.co.uk/news/1024/branded_news/C8CB/production/_129030415_gettyimages-1248367326.jpg', '2023-03-19T01:46:55Z', 'Switzerland\'s biggest bank, UBS, is reported to be in advanced talks to buy all or part of its troubled rival Credit Suisse. \r\nShares in Credit Suisse have fallen sharply in recent days after it said… [+1333 chars]', '2023-03-20 09:26:56'),
(24537, 'LW', 'Taylor Swift\'s Eras Tour takes fans on a fashion journey through time - Marca English', 'Taylor Swift is back on tour, kicking off her long-awaited Eras Tour on March 18th, 2023 at the State Farm Stadium in Glendale, Arizona. Fans eagerly awaited her return, and the po', 'https://www.marca.com/en/lifestyle/music/2023/03/19/6416632022601d91788b457d.html', 'https://phantom-marca.unidadeditorial.es/2eb6d0abbf7cf015cb1a8ab6d397c6e6/resize/1200/f/jpg/assets/multimedia/imagenes/2023/03/19/16791881145178.jpg', '2023-03-19T01:26:00Z', 'Taylor Swift is back on tour, kicking off her long-awaited Eras Tour on March 18th, 2023 at the State Farm Stadium in Glendale, Arizona. Fans eagerly awaited her return, and the pop superstar did not… [+2171 chars]', '2023-03-20 09:26:56'),
(24538, NULL, 'Gov. Newsom visits Downey, announces plans to reduce insulin price, manufacture naloxone - KCAL News', 'California Governor Gavin Newsom visited Downey on Saturday and announced a partnership with a pharmaceutical company intended to provide insulin to Californ...', 'https://www.youtube.com/watch?v=wUFcZGGbszo', 'https://i.ytimg.com/vi/wUFcZGGbszo/maxresdefault.jpg', '2023-03-19T01:25:35Z', NULL, '2023-03-20 09:26:56'),
(24539, 'Julia Shapero', 'Police supervisor in Tyre Nichols’ death retired with benefits day prior to termination hearing: reports - The Hill', 'The police supervisor who responded to the scene of Tyre Nichols’ arrest retired with benefits the day before his termination hearing, according to media reports. Lt. DeWayne Smith, who spent 25 years on the Memphis police force, was facing disciplinary charg…', 'https://thehill.com/homenews/state-watch/3906979-police-supervisor-in-tyre-nichols-death-retired-with-benefits-day-prior-to-termination-hearing-reports/', 'https://thehill.com/wp-content/uploads/sites/2/2023/03/fe70287ae300429e844cdd3be7aad93a.jpg?w=1280', '2023-03-19T01:16:00Z', 'Skip to content\r\nThe police supervisor who responded to the scene of Tyre Nichols’ arrest retired with benefits the day before his termination hearing, according to media reports.\r\nLt. DeWayne Smith,… [+1745 chars]', '2023-03-20 09:26:56'),
(24540, 'Kaitlan Collins, Kristen Holmes, Paula Reid', 'Trump says he expects to be arrested Tuesday as New York law enforcement prepares for possible indictment - CNN', 'Former President Donald Trump said Saturday he expects to be arrested in connection with the investigation by the Manhattan District Attorney next week', 'https://www.cnn.com/2023/03/18/politics/donald-trump-manhattan-da-arrest-protests/index.html', 'https://media.cnn.com/api/v1/images/stellar/prod/221215095659-donald-trump-file-0822.jpg?c=16x9&q=w_800,c_fill', '2023-03-19T00:08:00Z', 'Former President Donald Trump said Saturday he expects to be arrested in connection with the yearslong investigation into a hush money scheme involving adult film actress Stormy Daniels and called on… [+7587 chars]', '2023-03-20 09:26:56'),
(24541, 'The Associated Press', 'Snowy Michigan pileup ensnares up to 100 vehicles - ABC News', 'Michigan police say up to 100 vehicles were involved in a massive pileup on Interstate 96 during white-out conditions', 'https://abcnews.go.com/US/wireStory/snowy-michigan-pileup-ensnares-100-vehicles-97965392', 'https://s.abcnews.com/images/US/abc_news_default_2000x2000_update_16x9_992.jpg', '2023-03-19T00:04:43Z', 'LANSING, Mich. -- Up to 100 vehicles were involved in a massive pileup on Interstate 96 during white-out conditions, Michigan police said. \r\nThere were reports of injuries that do not appear to be se… [+400 chars]', '2023-03-20 09:26:56'),
(24542, 'Andrea Vacchiano', 'Trump 2024 opponent Vivek Ramaswamy slams possible looming indictment: \'Dark moment in American history\' - Fox News', 'Vivek Ramaswamy, a Republican contender for the 2024 presidential election, came to President Donald Trump\'s defense regarding his expected indictment, calling it \'un-American\'.', 'https://www.foxnews.com/politics/trump-2024-opponent-vivek-ramaswamy-slams-possible-looming-indictment', 'https://static.foxnews.com/foxnews.com/content/uploads/2023/03/32bacf9d-Untitled-design-7.png', '2023-03-18T23:18:00Z', 'Republican presidential candidate Vivek Ramaswamy criticized rumors of President Trump\'s possible looming indictment on Saturday, calling it \"un-American\" to prosecute the former president.\r\n\"It is u… [+2343 chars]', '2023-03-20 09:26:56'),
(24543, 'Karolina', 'Raquel Leviss Claimed That Tom Sandoval Affair Started After Vanderpump Rules Trip - Yahoo Entertainment', 'Neither Tom Sandoval nor Raquel Leviss has pinpointed when their affair started. All that is known is a timeline of roughly seven months. Maybe such details ...', 'https://www.yahoo.com/entertainment/raquel-leviss-claimed-tom-sandoval-222100115.html', 'https://media.zenfs.com/en/reality_tea_694/7e3d911df7bbaf550fc10074098383b4', '2023-03-18T22:21:00Z', 'Neither Tom SandovalnorRaquel Leviss has pinpointed when their affair started. All that is known is a timeline of roughly seven months. Maybe such details are spared to respect Toms ex-girlfriend Ari… [+5136 chars]', '2023-03-20 09:26:56'),
(24544, NULL, 'In France, some protests against increased retirement age turn violent - CBS News', 'The protests come after French President Emmanuel Macron unilaterally pushed through a bill to raise the nation\'s retirement age from 62 to 64.', 'https://www.cbsnews.com/news/france-protests-against-increased-retirement-age-turn-violent/', 'https://assets1.cbsnewsstatic.com/hub/i/r/2023/03/18/add5464a-b3ef-40a1-816b-000a66ac56a7/thumbnail/1200x630/e7e58c421442b2585b4dc4a6f6f6bf5f/gettyimages-1248386185.jpg', '2023-03-18T22:12:01Z', 'A smattering of protests against President Emmanuel Macron\'s plan to raise France\'s retirement age from 62 to 64 took place Saturday in Paris and beyond, as uncollected garbage continued to reek in t… [+3315 chars]', '2023-03-20 09:26:56');

-- --------------------------------------------------------

--
-- Table structure for table `replays`
--

CREATE TABLE `replays` (
  `id` int NOT NULL,
  `replay` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` int NOT NULL,
  `comment_id` int NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `replays`
--

INSERT INTO `replays` (`id`, `replay`, `id_user`, `comment_id`, `created_date`, `updated_date`) VALUES
(30, 'another replay to number 3 ...', 2, 3, '2023-03-17 17:30:45', '2023-03-17 17:30:45'),
(39, 'Esse, iste? Obcaecati, numquam nihil! Esse, qui minus cupiditate pariatur assumenda blanditiis voluptatibus nihil eligendi laudantium', 2, 42, '2023-03-17 18:08:04', '2023-03-17 18:08:04'),
(40, 'dignissimos ducimus maxime minima vitae! Quasi veniam porro fuga eveniet itaque asperiores similique voluptatum magni, ipsa nesciunt quidem molestias mollitia eos quae', 2, 5, '2023-03-17 18:08:47', '2023-03-17 18:08:47'),
(43, 'This is a test replay to another replay ... ', 1, 3, '2023-03-31 12:43:38', '2023-03-31 12:43:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '../images/no-image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `profile_image`) VALUES
(1, 'Test Name', 'testName', 'test@example.com', 'qy/4xomGmP7CU', '../images/646f005de4a23-641451f863be6-pexels-luis-del-río-15286.jpg'),
(2, 'John Doe', 'johnDoe', 'doe@example.com', 'qy/4xomGmP7CU', '../images/no-image.jpg'),
(28, 'Test User', 'test', 'testNew@example.com', 'qy/4xomGmP7CU', '../images/no-image.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users_edc` (`id_user`),
  ADD KEY `comments_news` (`id_news`);

--
-- Indexes for table `like_dislike_comments`
--
ALTER TABLE `like_dislike_comments`
  ADD PRIMARY KEY (`id_user`,`comment_id`);

--
-- Indexes for table `like_dislike_news`
--
ALTER TABLE `like_dislike_news`
  ADD PRIMARY KEY (`id_news`,`id_user`),
  ADD KEY `id_users_like` (`id_user`);

--
-- Indexes for table `like_dislike_replays`
--
ALTER TABLE `like_dislike_replays`
  ADD PRIMARY KEY (`id_user`,`replay_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `replays`
--
ALTER TABLE `replays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replay_users` (`id_user`),
  ADD KEY `replay_comments` (`comment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24565;

--
-- AUTO_INCREMENT for table `replays`
--
ALTER TABLE `replays`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_news` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_users_edc` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like_dislike_news`
--
ALTER TABLE `like_dislike_news`
  ADD CONSTRAINT `id_news_like` FOREIGN KEY (`id_news`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `id_users_like` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `replays`
--
ALTER TABLE `replays`
  ADD CONSTRAINT `replay_comments` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replay_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

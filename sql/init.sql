-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 01, 2025 at 06:14 PM
-- Server version: 11.7.2-MariaDB-ubu2404
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `image` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `artistId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `image`, `name`, `link`, `artistId`) VALUES
(1, 37, 'Forget the World', 'https://open.spotify.com/album/7G1441qDQeERZDyMipQPE8?si=GProKPmSQ0OHzCR1fGzcwQ', 1),
(2, 38, 'Embrace', 'https://open.spotify.com/album/7G53des9iRPuUydeFXXNGy?si=LDSaFDilSgidDO-I-5d4AQ', 2),
(3, 39, 'United We Are', 'https://open.spotify.com/album/1O1NYpjxvKvCOF36QBYrt4?si=cAx9RaoORRybU67e5klIiA', 3),
(4, 40, 'Monocule (Volume 2)', 'https://open.spotify.com/album/0Lo3tsG5drmteljSwQX01I?si=13tzaXihRA-9UKp9-QUKhA', 4),
(5, 41, 'Kaleidoscope', 'https://open.spotify.com/album/3L7HojVI3ELv05boMWUKDv?si=7cUcRdw_Siaqtt2oJISdoA', 5),
(6, 42, '2019 Remixed', 'https://open.spotify.com/album/3z4efVJv1e3GmoR7PybqHR?si=v1HcdZ4CQFmvEtMcO20WzA', 6),
(7, 44, 'Feel Again, Pt.1', 'https://open.spotify.com/album/0qAboyaRSktRsruN80Y7Ck?si=KlDbWJPtT32ecEhkm7k7WA', 2),
(8, 43, 'Press Play', 'https://open.spotify.com/album/0uFjuvvPvAogvwXnxp4HyS?si=sY1K3W9DT264XHlR5m_PeA', 1),
(9, 45, 'I Am Hardwell', 'https://open.spotify.com/album/1c8VPF74qax6iaGsf74cQ8?si=TKRihsKoSk699FomXrLVyw', 3),
(10, 46, 'Nights With You EP', 'https://open.spotify.com/album/4DgJoTQ8sVnC56C4uCPSeq?si=RE-iXl4vS9SefyIeRFNlQg', 4),
(11, 47, 'Just Be', 'https://open.spotify.com/album/3E8N6fNnqcOwNwUvALrqZ5?si=VEhWl86EQoGrR8wmdj-sSA', 5),
(12, 48, 'Sentio', 'https://open.spotify.com/album/45gsxfnJ5Nt2RZp82SQenc?si=EnZE9t1zRaa6Cys8tLRpng', 6),
(13, 49, 'AFROJACK presents NLW', 'https://open.spotify.com/album/75RGowCIexodcFrLNjnYCv?si=t1_dNQ0YQhq8wqNdXYJv9Q', 1),
(14, 50, 'Balance', 'https://open.spotify.com/album/5cqwXF2j9LkvFInBFlnQd3?si=ZBhRW-H_T6iVmIAhHLuvOQ', 2),
(15, 51, 'Rebels Never Die', 'https://open.spotify.com/album/5OU4esREA0HLwNekPigYeZ?si=e6UIuL4VTAmFBoXNbUGJNg', 3),
(16, 52, 'Turn Off The Lights', 'https://open.spotify.com/album/38RAjvvIzYVJPwYfYSg1le?si=TwzAQOHCS7qg06_dZCtRFw', 4),
(17, 53, 'Together', 'https://open.spotify.com/album/6jd8wvEoi6sCzP92Vt7CPZ?si=WzrwmYPhS7GsdhRxoB0N7A', 5),
(18, 54, 'Hero', 'https://open.spotify.com/album/1D8XFqGY27IpYFAKB61h8v?si=UIBJkgo1SKe3X2pXS6r7XA', 6),
(19, 301, 'In The Dark', 'https://open.spotify.com/album/0JSFYrV0NvRwHKxAJtZP6q?si=eTLTGQZsSh2UqlDgc0HiUg', 7),
(20, 302, 'Gumbo Kings EP', 'https://open.spotify.com/album/5n1hQCehRrnDtuy9x2Y4NM?si=vFLI7I2DRYm_eVod2cMz_g', 7),
(21, 303, 'The One', 'https://open.spotify.com/album/1tTjR96Oq4OFZtW2JF1ph8?si=hqkX3KW-RuO4vtL7sGJmXQ', 9),
(22, 304, 'Home Cooking', 'https://open.spotify.com/album/3rcysrlQvRv3kgZR461Lz7?si=yQHLh5HWQiqjsLJeKVhoSg', 9),
(23, 305, 'The Biggest Sin', 'https://open.spotify.com/album/690EwCQh6Iza9iRCDN3HCC?si=TccOOT4AQLixAZPrpxaf1A', 10),
(24, 306, 'ScandalouS', 'https://open.spotify.com/album/1xVEfD6c0cR4086hzESSSR?si=l_YFNeqTQPaLhNeOVOVUNA', 10),
(25, 307, 'New Dimension Of Life EP', 'https://open.spotify.com/album/6hLup1gUzopaXkxJyd963q?si=rvOOA3-0R0iLqNvMJs2YaQ', 14),
(26, 307, 'New Dimension of Life', 'https://open.spotify.com/album/6eR5k2olaJkxJSMPXbPboH?si=_0kdkDeRS3KZMubyf6XiTw', 14),
(27, 308, 'June', 'https://open.spotify.com/album/3lVBElZ1GpHZixzs21RnBp?si=M42tIuz2Q7iFym19C3OFtg', 15),
(28, 309, 'Beloved', 'https://open.spotify.com/album/7AjeBnQC2rhpZWVWfEqKQq?si=_Sy21QZ9Rh-CKsxvJDTtvw', 15),
(29, 310, 'Born In Black & White', 'https://open.spotify.com/album/4Dx1QtaVYHlQLvfXp9GxQW?si=CHUeqZQQSPSbqQ5-UqnkAA', 16),
(30, 311, 'Just Being Me', 'https://open.spotify.com/album/20xKk3TGGb1kZTrdY09V9r?si=iDYhH7xJRxShQxbv5EiXNA', 16),
(31, 312, 'Sex\'N\'Jazz', 'https://open.spotify.com/album/2FsQxTMicdpyAokUYgQPTF?si=9BuooqHOSF-rvenl7FXbTw', 19),
(32, 313, 'Love For Lunch', 'https://open.spotify.com/album/5xU3QFVbvwS4q5n9vpAWMz?si=RlNN86XmSJCJt4v2CKqI5w', 19),
(33, 314, 'All Right', 'https://open.spotify.com/album/5fdSX3HP0gruCkCz0SrIQc?si=lnsFXmyAQdWuRVAQ2Tdg9w', 20),
(34, 315, 'Walking On Fire', 'https://open.spotify.com/album/19hTB54kAtXZM0YPQb1oiG?si=7slsymCFR7KCuyC5ge5j5w', 20),
(35, 316, 'Lilith Merlot EP', 'https://open.spotify.com/album/2LsarF7MWgoNLK8DsCC1d9?si=G_OKVEnETwK-aBUmk1yMcw', 24),
(36, 317, 'Speak Your Heart', 'https://open.spotify.com/album/6XWyL2HcchIDLcTQCcE4Hy?si=HdMfXIELT0izBgfteXfshA', 24),
(37, 318, 'The Laughing Owl', 'https://open.spotify.com/album/0oYmXXvxF8SzxpcNfKV1Fg?si=eEzCdt6KQmWMMfXQUlliOg', 22),
(38, 319, 'Monk Vol.1', 'https://open.spotify.com/album/2Z6rHsjkPtq3NS9cKGLWWx?si=D4UZsVKcQKSdgb3wa2d6fw', 22),
(39, 325, 'Championships', 'https://open.spotify.com/album/11CyESxdaPU7YyCPhkYbWy?si=ra8wbRzJT6OhVPXVeg2Rmg', 12),
(40, 326, 'Goed Teken', 'https://open.spotify.com/album/08XCGZJvFATyHBwUzddDyn?si=asdf8n26Tkq4Fw17inZWaQ', 12),
(41, 336, 'After Hours', 'https://open.spotify.com/album/6qieofd8O9d76oDSrGQ9gN?si=-3UKnLYYTQGBxXy2LxVglQ', 8),
(42, 337, 'Deeper Than The Sea', 'https://open.spotify.com/album/0LdbUUGUyJRz6ZKdShrZcm?si=NSjAUXkaSoySWci3sLKHmw', 8);

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `api_key` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `api_key`) VALUES
(13, '6DC63D26-B922-E5D6-6665-4A8C48408A06'),
(15, '30229497-074A-E80E-4FD2-D1A61FCA830B'),
(16, 'DCB5ECBF-A63A-8C03-0FB6-934077F6A95E'),
(17, '431131A3-99A9-BEAD-A8F9-CF1367A13953'),
(20, 'B0157529-5BB5-44A5-B583-12D408507906'),
(21, 'F25F2590-1F7A-9DDB-0AFE-680E03C8E26C'),
(22, '33D633FE-8043-CC6F-05F8-7991069714A5'),
(23, '8488D0C8-29C5-11B8-5498-C0F440E95F7B'),
(24, '249EBDF8-953C-31B6-18E7-943D28406635'),
(25, 'F7D99861-0DB2-729A-6454-FDB8434A1D95'),
(27, '34C62D2E-E6CC-64C6-1130-6BF8A36004B9');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `headerImg` int(11) NOT NULL,
  `thumbnailImg` int(11) NOT NULL,
  `logo` int(11) NOT NULL,
  `spotify` varchar(100) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`, `description`, `type`, `headerImg`, `thumbnailImg`, `logo`, `spotify`, `image`) VALUES
(1, 'Afrojack', 'Nick Leonardus van de Wall (born 9 September 1987), better known as Afrojack, is a Dutch DJ, record producer and remixer from Spijkenisse. In 2007, he founded the record label Wall Recordings; his debut album Forget the World was released in 2014. Afrojack regularly features as one of the ten best artists in the Top 100 DJs published by DJ Mag. He is also the CEO of LDH Europe.\r\nSince 2007, Afrojack runs his own label, Wall Recordings, which represents producers including KIIDA, Apster, D-Wayne, D.O.D, Karim Mika, and others. The label used to operate as a sub-label to Spinnin&#039; Records until late January 2016. Tom &amp; Jame&#039;s Burn Down marked the last release of Wall Recordings as a sub-label. After going independent for a while, it became a sub-label to Armada Music in 2017, until it became independent again in 2019. His music genre is House.', 'dance', 7, 8, 25, 'https://open.spotify.com/embed/track/3wfNiPBrzDwuanE75Ar6pS?utm_source=generator', 31),
(2, 'Armin Van Buuren', 'Armin Jozef Jacobus Daniël van Buuren (born 25 December 1976) is a Dutch DJ and record producer from Leiden, South Holland. Since 2001, he has hosted A State of Trance (ASOT), a weekly radio show, which is broadcast to nearly 40 million listeners in 84 countries on over 100 FM radio stations. According to the website DJs and Festivals, \"the radio show propelled him to stardom and helped cultivate an interest in trance music around the world.\"\nIn 2017, Armin van Buuren announced he will be releasing an online MasterClass sharing his expertise in electronic music production. On 13 April 2017, Armin van Buuren performed at the Heineken stage in Shanghai, in the first Formula 1 Festival along with Angela Zhang.\nArmin performed a seven-hour-long set at the Romania Untold Festival on 6 August 2018, clocking from 2:00 a.m. to after 9:00 a.m. This outlasted his previous 2017 ASOT performance, which had gone on for five hours. His music genre is Trance and Techno.', 'dance', 9, 10, 26, 'https://open.spotify.com/embed/track/4ECA0jaumK20cc7vCqoYAA?utm_source=generator&theme=0', 32),
(3, 'Hardwell', 'Robbert van de Corput (born 7 January 1988), known professionally as Hardwell, is a Dutch DJ, record producer and remixer from Breda. Hardwell was voted the world\'s number one DJ on DJ Mag in 2013 and again in 2014. He was ranked at number twelve in the top 100 DJs 2019 poll by DJ Mag. Hardwell is best known for his sets at music festivals, including Ultra Music Festival, Sunburn and Tomorrowland.\nOn his debut studio album, United We Are, he used trance music synths for the first time for his track \"Echo\" as well as deep house sounds for \"Birds Fly\". In addition, \"Chameleon\" is based on the jungle-terror genre, which was similar with the W&W single \"Get Down\". For the first time since \"Don\'t Stop the Madness\", \"Hollywood\" embodies a track corresponded to the dirty-German-music. His music genre is Dance and House.', 'dance', 11, 12, 27, 'https://open.spotify.com/embed/track/7jRUGNzGNvBThHvgTYFhIE?utm_source=generator&theme=0', 33),
(4, 'Nicky Romero', 'Nick Rotteveel (born 6 January 1989), professionally known as Nicky Romero or Monocule, is a Dutch DJ, record producer and remixer from Amerongen, Utrecht Province. He has worked with, and received support from DJs, such as Tiësto, Fedde le Grand, Sander van Doorn, David Guetta, Calvin Harris, Armand van Helden, Avicii and Hardwell. He currently ranks at number 26 on DJ Mag\'s annual Top 100 DJs poll. He is known for his viral hit song \"Toulouse\".\nAs Romero has become more popular, he has become the target of criticism from underground music producers and underground music satire web articles; subjects include his actual abilities and contribution to the electronic music canon. Critics have targeted his style, his appearance and his music-production abilities. Such suggestions describes elements of Romero\'s abilities as brief and insufficient. Romero has since rebuffed the suggestions as minor. His music genre is Electrohouse and Progressive House.', 'dance', 13, 14, 28, 'https://open.spotify.com/embed/track/1sh6lL6cmlcwhqZKGiKBua?utm_source=generator&theme=0', 34),
(5, 'Tiesto', 'Tijs Michiel Verwest ( born 17 January 1969), known professionally as Tiësto, is a Dutch DJ and record producer from Breda, North Brabant. He was voted \"the Greatest DJ of All Time\" by Mix magazine in a 2010/2011 poll amongst fans. In 2013, he was voted by DJ Mag readers as the \"best DJ of the last 20 years\". He is also regarded as the \"Godfather of EDM\" by many sources.\nIn 1997, he founded the label Black Hole Recordings with Arny Bink, where he released the Magik and In Search of Sunrise CD series. Tiësto met producer Dennis Waakop Reijers in 1998; the two have worked together extensively since then.\nFrom 1998 to 2000, Tiësto collaborated with Ferry Corsten under the name Gouryella. His 2000 remix of Delerium\'s \"Silence\" featuring Sarah McLachlan exposed him to more mainstream audiences. His played music genre is Trance, Techno, Minimal, House and Electro.', 'dance', 15, 16, 29, 'https://open.spotify.com/embed/track/18asYwWugKjjsihZ0YvRxO?utm_source=generator&theme=0', 35),
(6, 'Martin Garrix', 'Martijn Gerard Garritsen (born 14 May 1996), known professionally as Martin Garrix, is a Dutch disc jockey who was ranked number one on DJ Mag\'s Top 100 DJs list for three consecutive years—2016, 2017, and 2018. His most known singles are \"Animals\", \"In the Name of Love\" and \"Scared to Be Lonely\". He is also known by his pseudonyms \"Ytram\" and \"GRX\".\nHe has performed at music festivals such as Coachella, Electric Daisy Carnival, Ultra Music Festival, Tomorrowland, and Creamfields. In 2014 he headlined the 1st edition of Ultra South Africa making this his first major festival. In the same year he became the youngest DJ to headline 2014 Ultra Music Festival at the age of 17. He was a resident DJ at Spain\'s Hï Ibiza (2017) and Ushuaïa Ibiza (2016 and 2018). He founded the label Stmpd Rcrds in 2016, months after leaving Spinnin\' Records and before signing with Sony Music. His music genre is Dance and Electronic.', 'dance', 17, 18, 30, 'https://open.spotify.com/embed/track/23L5CiUhw2jV1OIMwthR3S?utm_source=generator&theme=0', 36),
(7, 'Gumbo Kings', 'A five-person alligator that comes from the Dutch swamp delta crawled. Very tight in the suit also. These young musicians have a modern and completely own view of their beloved Soul & Rhythm\'s blues. The live show of Gumbo Kings brings you into a chic nightclub, where the party is slowly brought to the absolute boiling point. These guys are therefore genuine romantics. Just look out for the sharp teeth.\n\nSince its foundation, the band has been working on stage by miles on a growing crowd of fans. In 2019, Gumbo Kings was the most booked band of Pop Ronde. In 2020 the band was on the NPO Soul & Jazz Podium on Noorderslag.', 'jazz', 63, 64, 62, 'https://open.spotify.com/embed/track/514hjpdqFvFg2Eg5rJZbyW?utm_source=generator&theme=0', 61),
(8, 'Evolve', 'EVOLVE is the downtempo chillout project of artist/producer Red Broad. The first release, HAPPY HOUR IN THE GENE POOL has enjoyed great success within the downtempo chillout and lounge genres with ever popular and iconic tracks such as August Moon, Do You Know This One?, Well I Gotta Story and Couldn\'t Be More Wrong becoming regulars on radio stations such as Soma FM Groove Salad, Smooth Lounge, Chill With Mindi Abair and Sirius/XM Chill. Tracks from the album have also made appearances on TV shows including USA Networks “Royal Pains”, MTV’s “Road Rules” and “The Real World” and have been included on many chill out compilation albums including \"Best of 2011 Lounge\" \"Erotic Affairs\" \"Saint Tropez Summer Session\" \"Hed Kandi\"  to name but a few.', 'jazz', 56, 320, 320, 'https://open.spotify.com/embed/track/0u7IzJIDB2TzFV30W9w01z?utm_source=generator&theme=0', 320),
(9, 'Ntjam Rosie', 'Ntjam Rosie, born as Rosie Boei (March 18, 1983, in Sonkoe, Cameroon), is a Dutch-Cameroonian singer/songwriter from Rotterdam, The Netherlands. Her style is a mix of pop music, jazz and soul. She moved to the Netherlands at the age of nine where she grew up in Maastricht. Ntjam Rosie (then working under the name Ntjamrosie) released her debut album Atouba through Apple Tree Records on January 20, 2008. It was produced by Nelson & Djosa. The sound of the album is best described as Future Afro Soul. Patience was released as a single.\n\nShe graduated from the Codarts Conservatory Rotterdam as a bachelor of music. She majored in Latin singing and minored in teaching.', 'jazz', 65, 68, 67, 'https://open.spotify.com/embed/track/1qRfE2oMQkN28O2N4nMeLr?utm_source=generator&theme=0', 66),
(10, 'Wicked Jazz Sounds', 'Wicked Jazz Sounds is a Dutch music collective and event organizer located in Amsterdam founded in 2002. In May 2002, DJs Phil Horneman and Manne van der Zee organised their first WJS event. It took place at Aknathon, in Amsterdam. Horneman had previously used the Wicked Jazz Sounds name for a show on the Amstelveen local radio station, starting in 1998.', 'jazz', 71, 70, 72, 'https://open.spotify.com/embed/track/3i4KErpZfQzDc9z5zpljHa?utm_source=generator&theme=0', 69),
(11, 'Tom Thomson Assemble', 'It was a hundred years ago this Saturday that Tom Thomson, one of Canada’s most important painters, disappeared into the wilderness.  A magical evening called “The Woods Are Burning” is planned at The Historic Leith Church, the church that Thomson and his family attended when he was growing up in Leith, to mark the occasion with a celebration of his life and work presented in poetry and song.  At the helm of this production is singer-songwriter David Sereda, and he has assembled some of the area’s most impressive musicians along with internationally celebrated poet Anne Michaels to create “a long kind of journey in two parts about the painter and the place.', 'jazz', 56, 331, 331, 'https://open.spotify.com/embed/track/3mujiUHHprjquB4MHRauoi?utm_source=generator&theme=0', 331),
(12, 'Joanna Fraser', 'Jonna Fraser, full Jonathan Jeffrey Grando ( December 11, 1992 ), is a Dutch rapper and singer of Surinamese descent. He has a broad Dutch hop style that varies from gangsta rap to sultry soul . He released several albums, including Good sign that managed to reach the eleventh position of the album chart. The single Do or die , which he recorded with the rap formation Broederliefde , reached number 10 in 2016. He is also part of the rap collective New Wave , which won the 2015 Pop Prize.', 'jazz', 323, 321, 324, 'https://open.spotify.com/embed/track/2Y63yg1Lgdp96IoiZIvjKz?utm_source=generator&theme=0', 322),
(13, 'Fox & The Mayors', 'Fox & The Mayors is a dynamic jazz group based in Chicago, known for their fresh and eclectic sound that blends elements of traditional jazz, funk, and soul. Led by saxophonist Hunter Diamond, the group features a roster of top-notch musicians who bring their unique perspectives and improvisational skills to every performance. Their energetic live shows have garnered a devoted following and critical acclaim.', 'jazz', 56, 330, 330, 'https://open.spotify.com/embed/track/1fse6RDjgwSnYJt0LB6YFo?utm_source=generator&theme=0', 330),
(14, 'Uncle Sue', 'Uncle Sue is a seven-piece Funk and Soul Band from Haarlem with its own story, soul diva and swinging wind section. \nStubborn repertoire, from our own studio and slightly less obvious gems from our musical heroes. A sound that goes back to the 60\'s and 70\'s. Uncle Sue feels at home there. This is reflected in its own retro look. Tightly dressed with a classy energetic singer. Think of Sharon Jones & the Dap Kings, Bamboos, Slim Moore, James Brown, Amy Winehouse, Beck, Trombone Shorty, Otis Redding and others…', 'jazz', 77, 80, 79, 'https://open.spotify.com/embed/track/1k32rIGijWkOzQ61AJTEbr?utm_source=generator&theme=0', 78),
(15, 'Kris Allen', 'Kris Allen is the Lyell B. Clay Artist in Residence in Jazz and Lecturer in Music at Williams and the director of the Williams jazz ensemble program. He has forged a clear conceptual and aural identity as a saxophonist, composer, bandleader and recording artist, appearing on dozens of albums.', 'jazz', 97, 100, 99, 'https://open.spotify.com/embed/track/1yreKf9ACPupQROFc1Rmm6?utm_source=generator&theme=0', 98),
(16, 'Myles Sanko', 'Sanko, who grew up in a small town on the coast of Ghana , later emigrated to Britain with his family . He sang and rapped as a youngster in Cambridge . He later played with the group Bijoumiyo and accompanied Speedometer . With his self-released EP Born in Black & White in 2013 , Sanko became more known in Europe . The album Forever Dreaming followed in 2014 and Just Being Me in 2016 . He wrote some of the songs with Thierry Los . He has performed at the North Sea Jazz Festival ,Elbjazz , Rheingau Musik Festival [3] and Jazz & Joy Festival .', 'jazz', 73, 76, 75, 'https://open.spotify.com/embed/track/6uL0ZXwr17RgsMRmXKYY11?utm_source=generator&theme=0', 74),
(17, 'Ruis Soundsystem', 'Ruis Soundsystem is a product of the imagination, so any description of their sound or style would be purely speculative. However, based on the name \"Ruis Soundsystem,\" one might imagine a group that combines traditional jazz elements with electronic or experimental textures, creating a dynamic and innovative sound that pushes the boundaries of the genre.', 'jazz', 56, 332, 332, 'https://open.spotify.com/embed/track/3FsmxekJP2vHsoy1VTtsp9?utm_source=generator&theme=0', 332),
(18, 'The Family XL', 'The Family XL is a modern jazz group based in Haarlem City, known for their fusion of classic jazz elements with contemporary R&B and hip-hop influences. Led by pianist and composer Mark de Clive-Lowe, the group features a diverse array of talented musicians who bring their own unique perspectives to the music. Their music is both accessible and adventurous, blending catchy melodies with sophisticated harmonies and improvisation.', 'jazz', 56, 329, 329, 'https://open.spotify.com/embed/track/77aKjAafF8qar9i3d6F84P?utm_source=generator&theme=0', 329),
(19, 'Gare du Nord', 'Gare du Nord exists 20 years and celebrates this with a club tour along 20 stages in the Netherlands. Four years ago, the band said goodbye to the public, but now returns – especially for all fans – once with: Gare du Nord Encore – 20th anniversary tour! With singer Dorona Alberti as the radiant center, Gare du Nord has grown into an energetic live band that guarantees full houses. After saying goodbye to the Dutch public in 2018, the band returns once to various stages to celebrate the 20th anniversary with the fans.', 'jazz', 81, 84, 83, 'https://open.spotify.com/embed/track/1r73c3wbE08tI1ERVD75wu?utm_source=generator&theme=0', 82),
(20, 'Rilan & The Bombadiers', 'With a sold out first clubtour, a booming festival season and tracks that have already been featured in a number of big Hollywood productions, (Netflix / HULU / FOX: Shooter, Shut Eye and Rosewood) this band has certainly been keeping busy. Both nationally and abroad.\n\nThe energetic live show along with the charismatic and unique performance of frontman Rilan will give you a time to remember.', 'jazz', 85, 88, 87, 'https://open.spotify.com/embed/track/6ciOri7GZzNfDG5VipLYS1?utm_source=generator&theme=0', 86),
(21, 'Soul Six', 'As a jazz group, Soul Six is a product of the imagination, so any description of their sound or style would be purely speculative. However, based on the name \"Soul Six,\" one might imagine a group that combines elements of classic soul music with contemporary jazz, creating a sound that is both soulful and sophisticated. Their music might feature soulful vocals, tight grooves, and infectious melodies that get audiences dancing and feeling good.', 'jazz', 56, 328, 328, 'https://open.spotify.com/embed/track/2kKVMljr4aDJIH3Vxga5I3?utm_source=generator&theme=0', 328),
(22, 'Han Bennink', 'Drummer and multi-instrumentalist Han Bennink was born in Zaandam near Amsterdam in 1942. His first percussion instrument was a kitchen chair. Later his father, an orchestra percussionist, supplied him with a more conventional outfit, but Han never lost his taste for coaxing sounds from unlikely objects he finds backstage at concerts. He is still very fond of playing chairs.', 'jazz', 93, 96, 95, 'https://open.spotify.com/embed/track/2ulmcu2vawceXStHYQonH6?utm_source=generator&theme=0', 94),
(23, 'The Nordians', 'When Oene van Geel viola, Mark Tuinstra guitar and Niti Ranjan Biswas tabla virtuoso played together for the first time there where immediately fireworks, roaring u-turns and cinematic tearjerkers. Then they started writing songs together based on traditional ragas, smashing funk and delicate chamber music.\n\nThis gave them a great new impulse on stage for even more interaction and improvisation and made them build a rocking live reputation. They love to play with the three of them but they also play with special guests from around the globe such as Fraser Fifield whistle / pipes, Jorg Brinkmann cello, Maarten Ornstein bass clarinet, Theo Loevendie sop sax, Druba Ghosh sarangi, Bruno Ferro Xavier da Silva bass guitar, Barbara Schilstra (vocals), Bao Sisoko (kora) and Benedicte Maurseth hardanger fiddle.', 'jazz', 56, 327, 327, 'https://open.spotify.com/embed/track/1Q7hnUKlWfroCWFHGLwQ52?utm_source=generator&theme=0', 327),
(24, 'Lilith Merlot', '\nDutch singer and songwriter Lilith Merlot is known for her warm and deep voice with a timeless feel. \n\n \n\nGrowing up in a family of classically trained professional musicians, Lilith was enchanted by the beauty of harmony and melody from a very young age. Her youth was turbulent and she sought comfort in music, which you can hear in her original songs. “Even though, by now she is a mature, young woman, you can still hear a hint of the little, six year old girl in her songs, who just wants the sun to play on her face and for someone to stroke her hair.” (Jaap Koper for the Popunie, 2018). ', 'jazz', 89, 92, 91, 'https://open.spotify.com/embed/track/3d4k38C0dO6BWOkPn62eey?utm_source=generator&theme=0', 90),
(25, 'Nicky Romero B2B Afrojack', 'Prepare for a Back to Back session from the famous artists Nicky Romero and Afrojack.', 'b2b', 7, 333, 28, 'https://open.spotify.com/embed/track/3Xkf0dPNJbLMzi2BuGmbDo?utm_source=generator&theme=0', 34),
(26, 'Hardwell B2B Martin Garrix B2B Armin Van Buuren', 'Prepare for a crazy B2B session from our beloved Hardwell, Martin Garrix and Armin Van Buuren.', 'b2b', 11, 334, 30, 'https://open.spotify.com/embed/track/5AWkUtTlUjbDpQ5Fk4QJun?utm_source=generator&theme=0', 32),
(27, 'Afrojack B2B Tiesto B2B Nicky Romero', 'Come listen to a crazy combination of sounds from Afrojack Back 2 Back Tiesto Back 2 Back Nicky Romero.', 'b2b', 15, 335, 28, 'https://open.spotify.com/embed/track/2pydaff4kf72kKv6X9bpYX?utm_source=generator&theme=0', 31),
(41, 'Mira Elston', 'A versatile dancer with a passion for modern and lyrical styles, Mira brings fluidity and emotion to every stage she steps on. e', 'dance', 507, 508, 509, 'Dolorem do consequun', 510),
(42, 'Mira Elston', 'A versatile dancer with a passion for modern and lyrical styles, Mira brings fluidity and emotion to every stage she steps on.', 'jazz', 511, 512, 513, 'SAD', 514);

-- --------------------------------------------------------

--
-- Table structure for table `food_session`
--

CREATE TABLE `food_session` (
  `id` int(11) NOT NULL,
  `restaurantid` int(11) NOT NULL,
  `price` double NOT NULL,
  `reducedprice` double NOT NULL,
  `starttime` time(2) NOT NULL,
  `session_length` double NOT NULL,
  `available_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `food_session`
--

INSERT INTO `food_session` (`id`, `restaurantid`, `price`, `reducedprice`, `starttime`, `session_length`, `available_seats`) VALUES
(8, 4, 45, 22.5, '19:00:00.00', 2, 51),
(9, 5, 45, 22.5, '17:30:00.00', 1.5, 45),
(10, 4, 45, 22.5, '09:00:00.00', 1.5, 45),
(14, 5, 35, 17.5, '16:30:00.00', 1.5, 100),
(15, 4, 35, 17.5, '18:00:00.00', 1.5, 100),
(16, 5, 35, 17.5, '19:30:00.00', 1.5, 100),
(17, 4, 35, 17.5, '17:30:00.00', 1.5, 48),
(18, 5, 35, 17.5, '19:00:00.00', 1.5, 48);

-- --------------------------------------------------------

--
-- Table structure for table `history_event`
--

CREATE TABLE `history_event` (
  `id` int(11) NOT NULL,
  `tickets_available` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL,
  `datetime` datetime NOT NULL,
  `location` varchar(255) NOT NULL,
  `image` int(11) DEFAULT NULL,
  `tourguideID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `history_event`
--

INSERT INTO `history_event` (`id`, `tickets_available`, `price`, `datetime`, `location`, `image`, `tourguideID`) VALUES
(81, 7, 17.00, '2024-07-25 10:00:00', 'Teylers Museum ', 489, 20),
(83, 12, 17.00, '2024-07-26 10:00:00', 'Grote-Kerk-Haarlem ', 515, 21),
(84, 0, 35.00, '2024-07-27 10:00:00', 'Bavo Church', 550, 22),
(85, 12, 17.00, '2024-07-28 10:00:00', 'Bavo Church', 551, 20);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`) VALUES
(401, 'img1_68247b7b84ec1.jpg'),
(463, 'img1_68247b7b84ec1.jpg'),
(464, 'img2_68247b7b86c13.jpg'),
(465, 'img3_68247b7b880a3.jpg'),
(468, 'img_682478ca4a4dd.jpg'),
(469, 'img_68247908766e0.jpg'),
(470, 'img_6815fb3ab4c05.png'),
(471, 'img_6815fb6198d00.png'),
(472, 'img_6815fb8af0798.png'),
(473, 'img_6824792faf6e4.jpg'),
(474, 'img_6815fc1806cf4.jpg'),
(475, 'img_6815fc53c32f8.png'),
(476, 'img_6815fcf7659f7.png'),
(477, 'img_6815fd2e07bd2.jpg'),
(478, 'img_6815fd615eedf.jpg'),
(479, 'img_6815fd615eedf.jpg'),
(480, 'img_6815fd63bbab5.jpg'),
(481, 'img_6815fd63bbab5.jpg'),
(482, 'img_6815fde2af4c7.jpg'),
(483, 'img_6815fdec93df4.jpg'),
(484, 'img_6815fdec93df4.jpg'),
(485, 'img_6815fe31d76bc.jpg'),
(486, 'img_6815fe31d76bc.jpg'),
(487, 'img_6815fe3b27a1f.jpg'),
(489, 'img_6836deafaf1d8.jpg'),
(507, 'img_68247ee4843c0.jpg'),
(508, 'img_68247ee485663.jpg'),
(509, 'img_68247ee4862c8.jpg'),
(510, 'img_68247ee486fc2.jpg'),
(511, 'img_68247f22a1329.jpg'),
(512, 'img_68247f22a23a3.jpg'),
(513, 'img_68247f22a2dfa.jpg'),
(514, 'img_68247f22a39be.jpg'),
(515, 'img_6836dee8248b1.jpg'),
(520, 'img_68248130600a4.jpg'),
(521, 'img_68248150aa481.png'),
(522, 'img_6824814a21380.jpg'),
(523, 'img_6824814a227ad.png'),
(524, 'img_68186a17ccafe.png'),
(525, 'img_68186a42c97bf.png'),
(526, 'img_68186a568b2f5.png'),
(527, 'img_68186a76917d3.webp'),
(528, 'img_68186be493de6.png'),
(529, 'img_68186bf35dbf5.png'),
(530, 'img_68186f0a004cc.webp'),
(531, 'img_68186f15c0647.jpg'),
(532, 'img_68186f6692046.jpg'),
(533, 'img_68186f91a786b.png'),
(534, 'img_68187af425590.jpg'),
(535, 'img_68187b2607b5d.png'),
(536, 'img_68187b34cec1c.png'),
(537, 'img_68187b3a09017.png'),
(538, 'img_68187bda2e0ad.png'),
(539, 'img_68187be217358.png'),
(540, 'img1_68247b90d1cfa.jpg'),
(541, 'img2_68217618a5d73.jpg'),
(542, 'img3_68217618a6b03.png'),
(543, 'img_6821c70eb431e.jpg'),
(544, 'img_6821c7283b4dd.jpg'),
(545, 'img_6821c754df41f.jpg'),
(546, 'img_682d70be099e5.jpg'),
(547, 'img_682d70e10d249.jpg'),
(548, 'img_6834312e5626f.jpg'),
(549, 'img_683431765ecef.jpg'),
(550, 'img_6836dfa5ee3c8.jpg'),
(551, 'img_6836e20e3d95b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `music_event`
--

CREATE TABLE `music_event` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `artist` int(11) NOT NULL,
  `venue` int(11) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `tickets_available` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `image` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `music_event`
--

INSERT INTO `music_event` (`id`, `type`, `artist`, `venue`, `ticket_price`, `tickets_available`, `datetime`, `image`, `name`) VALUES
(1, 'dance', 25, 4, 75, 1497, '2023-07-27 20:00:00', 1, 25),
(2, 'dance', 5, 1, 60, 194, '2023-07-27 22:00:00', 5, 5),
(3, 'dance', 3, 3, 60, 300, '2023-07-27 23:00:00', 3, 3),
(4, 'dance', 2, 6, 60, 200, '2023-07-27 22:00:00', 2, 2),
(5, 'dance', 6, 5, 60, 200, '2023-07-27 22:00:00', 6, 6),
(6, 'dance', 26, 2, 110, 2000, '2023-07-28 14:00:00', 1, 26),
(7, 'dance', 1, 3, 60, 300, '2023-07-28 22:00:00', 1, 1),
(8, 'dance', 5, 4, 75, 1500, '2023-07-28 21:00:00', 5, 5),
(9, 'dance', 4, 1, 60, 200, '2023-07-28 23:00:00', 4, 4),
(10, 'dance', 27, 2, 110, 2000, '2023-07-29 14:00:00', 1, 27),
(11, 'dance', 2, 3, 60, 300, '2023-07-29 19:00:00', 2, 2),
(12, 'dance', 3, 6, 90, 1500, '2023-07-29 21:00:00', 3, 3),
(13, 'dance', 6, 1, 60, 200, '2023-07-29 18:00:00', 6, 6),
(14, 'jazz', 7, 8, 15, 300, '2023-07-26 18:00:00', 1, 7),
(15, 'jazz', 8, 8, 15, 300, '2023-07-26 19:30:00', 1, 8),
(16, 'jazz', 9, 8, 15, 300, '2023-07-26 21:00:00', 1, 9),
(17, 'jazz', 10, 9, 10, 200, '2023-07-26 18:00:00', 1, 10),
(18, 'jazz', 11, 9, 10, 200, '2023-07-26 19:30:00', 1, 11),
(19, 'jazz', 12, 9, 10, 200, '2023-07-26 21:00:00', 1, 12),
(20, 'jazz', 13, 8, 15, 300, '2023-07-27 18:00:00', 1, 13),
(21, 'jazz', 14, 8, 15, 300, '2023-07-27 19:30:00', 1, 14),
(22, 'jazz', 15, 8, 15, 300, '2023-07-27 21:00:00', 1, 15),
(23, 'jazz', 16, 9, 10, 200, '2023-07-27 18:00:00', 1, 16),
(24, 'jazz', 17, 9, 10, 200, '2023-07-27 19:30:00', 1, 17),
(25, 'jazz', 18, 9, 10, 200, '2023-07-27 21:00:00', 1, 18),
(26, 'jazz', 19, 8, 15, 300, '2023-07-28 18:00:00', 1, 19),
(27, 'jazz', 20, 8, 15, 299, '2023-07-28 19:30:00', 1, 20),
(28, 'jazz', 21, 8, 15, 300, '2023-07-28 21:00:00', 1, 21),
(29, 'jazz', 22, 10, 10, 150, '2023-07-28 18:00:00', 1, 22),
(30, 'jazz', 23, 10, 10, 150, '2023-07-28 19:30:00', 1, 23),
(31, 'jazz', 24, 10, 10, 150, '2023-07-28 21:00:00', 1, 24),
(32, 'jazz', 17, 7, 0, 10000, '2023-07-29 15:00:00', 1, 17),
(33, 'jazz', 10, 7, 0, 10000, '2023-07-29 16:00:00', 1, 10),
(34, 'jazz', 8, 7, 0, 10000, '2023-07-29 17:00:00', 1, 8),
(35, 'jazz', 23, 7, 0, 10000, '2023-07-29 18:00:00', 1, 23),
(36, 'jazz', 7, 7, 0, 10000, '2023-07-29 19:00:00', 1, 7),
(37, 'jazz', 19, 7, 0, 10000, '2023-07-29 20:00:00', 1, 19),
(55, 'dance', 38, 45, 455, 60, '2026-03-02 02:00:00', 544, 38),
(57, 'Select type', 38, 46, 7364, 3226, '2025-05-14 19:06:00', 545, 38),
(58, 'dance', 41, 46, 18, 58, '2025-05-21 12:20:00', 546, 41),
(59, 'jazz', 41, 46, 20, 78, '2025-05-21 12:21:00', 547, 41),
(60, 'jazz', 41, 45, 22, 22, '2023-07-30 15:14:00', 548, 41),
(61, 'dance', 42, 46, 22, 22, '2023-07-28 15:16:00', 549, 42);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `birthdate` datetime DEFAULT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `streetAddress` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipCode` varchar(45) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totalprice` decimal(11,2) NOT NULL,
  `paymentId` varchar(13) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `firstName`, `lastName`, `birthdate`, `emailAddress`, `streetAddress`, `country`, `zipCode`, `phoneNumber`, `user_id`, `totalprice`, `paymentId`, `created_at`) VALUES
(101, 'Eugenia', 'Pena', '1977-01-03 00:00:00', 'demo@user.com', 'Aliquip reiciendis v', 'Rerum dolor velit om', '73977', '+1 (263) 406-5256', 31, 36.00, 'tr_RKs6cBDyQZ', '2025-05-06 10:50:47'),
(102, 'Adena', 'Pittman', '1998-01-05 00:00:00', 'demo@user.com', 'In laborum voluptate', 'Dignissimos magnam v', '58588', '+1 (272) 169-9803', 31, 18.00, 'tr_urwmrCTNPo', '2025-05-06 11:06:52'),
(105, 'Isadora', 'Spears', '1984-04-02 00:00:00', 'demo@user.com', 'Perspiciatis volupt', 'Velit sed voluptate', '33768', '+1 (885) 664-1209', 31, 455.00, 'tr_pSrNmeexXG', '2025-05-06 11:16:36'),
(106, 'Darryl', 'Holt', '1995-05-04 00:00:00', 'demo@user.com', 'Pariatur Aliquid ut', 'Ea consequuntur at a', '24915', '+1 (653) 286-8722', 31, 455.00, 'tr_76twJPjDvD', '2025-05-08 07:47:16'),
(109, 'Farrah', 'Franks', '1980-08-23 00:00:00', 'demo@user.com', 'Dolorum et velit vo', 'Ut veniam pariatur', '99548', '+1 (977) 858-9786', 31, 18.00, 'tr_hVM7hGu7kh', '2025-05-08 09:06:51'),
(110, 'Lenore', 'Hebert', '1996-04-18 00:00:00', 'demo@user.com', 'Beatae esse reicien', 'Proident itaque par', '63244', '+1 (949) 321-8399', 31, 455.00, 'tr_xztN5cwaym', '2025-05-08 09:41:29'),
(114, 'Reese', 'Larson', '2002-12-09 00:00:00', 'demo@user.com', 'Totam duis officia r', 'Commodi dolorem veli', '83109', '+1 (179) 189-6895', 31, 18.00, 'tr_Ku9uYNV3HG', '2025-05-08 09:51:39'),
(116, 'Graiden', 'Robles', '1978-11-26 00:00:00', 'demo@user.com', 'Reprehenderit aut co', 'Voluptas ut enim eos', '44090', '+1 (478) 729-4588', 31, 18.00, 'tr_Y8jUvFH87w', '2025-05-08 10:10:08'),
(117, 'Dylan', 'Chapman', '1995-11-17 00:00:00', 'haarlemfestivalrecovery1@gmail.com', 'Minim aut perferendi', 'Ut delectus eu sequ', '70998', '+1 (429) 328-5872', 6, 34.00, 'tr_fLfRou59Ja', '2025-05-11 09:56:54'),
(119, 'Maisie', 'Cherry', '1997-10-21 00:00:00', 'demo@user.com', 'Qui consectetur quo ', 'Dolor amet sunt pro', '62344', '+1 (427) 305-6472', 31, 18.00, 'tr_2acUxUdjsj', '2025-05-11 10:17:12'),
(120, 'Kellie', 'Foley', '1987-09-24 00:00:00', 'demo@user.com', 'Culpa Nam fugit rer', 'Culpa et neque magni', '62226', '+1 (215) 358-5232', 31, 18.00, NULL, '2025-05-11 10:34:48'),
(121, 'Kellie', 'Foley', '1987-09-24 00:00:00', 'demo@user.com', 'Culpa Nam fugit rer', 'Culpa et neque magni', '62226', '+1 (215) 358-5232', 31, 18.00, NULL, '2025-05-11 10:36:16'),
(122, 'Kellie', 'Foley', '1987-09-24 00:00:00', 'demo@user.com', 'Culpa Nam fugit rer', 'Culpa et neque magni', '62226', '+1 (215) 358-5232', 31, 18.00, NULL, '2025-05-11 10:36:47'),
(123, 'Kellie', 'Foley', '1987-09-24 00:00:00', 'demo@user.com', 'Culpa Nam fugit rer', 'Culpa et neque magni', '62226', '+1 (215) 358-5232', 31, 18.00, NULL, '2025-05-11 10:37:03'),
(124, 'Kellie', 'Foley', '1987-09-24 00:00:00', 'demo@user.com', 'Culpa Nam fugit rer', 'Culpa et neque magni', '62226', '+1 (215) 358-5232', 31, 18.00, NULL, '2025-05-11 10:37:25'),
(125, 'Kellie', 'Foley', '1987-09-24 00:00:00', 'demo@user.com', 'Culpa Nam fugit rer', 'Culpa et neque magni', '62226', '+1 (215) 358-5232', 31, 18.00, NULL, '2025-05-11 10:38:10'),
(126, 'Kellie', 'Foley', '1987-09-24 00:00:00', 'demo@user.com', 'Culpa Nam fugit rer', 'Culpa et neque magni', '62226', '+1 (215) 358-5232', 31, 18.00, NULL, '2025-05-11 10:38:15'),
(127, 'Veronica', 'Bradley', '1999-03-23 00:00:00', 'demo@user.com', 'Enim possimus Nam a', 'Tempor fuga Rerum h', '27826', '+1 (453) 792-4165', 31, 18.00, NULL, '2025-05-11 10:47:12'),
(128, 'Ora', 'Berry', '2012-07-17 00:00:00', 'demo@user.com', 'Beatae unde suscipit', 'Fugiat rerum quo ea', '21319', '+1 (141) 737-6421', 31, 18.00, NULL, '2025-05-11 10:48:49'),
(129, 'Steel', 'Baird', '1987-07-09 00:00:00', 'demo@user.com', 'Enim qui aliquid inc', 'Dolores et proident', '63705', '+1 (502) 833-3503', 31, 18.00, 'tr_B6ms8PM7ep', '2025-05-11 10:50:35'),
(130, 'Malachi', 'Kelley', '2012-12-14 00:00:00', 'demo@user.com', 'Eos pariatur Est ', 'Ab dolor vel Nam exe', '50336', '+1 (649) 776-1938', 31, 18.00, 'tr_oTQGCcRQPF', '2025-05-11 10:50:59'),
(131, 'Donna', 'Hutchinson', '1979-07-02 00:00:00', 'demo@user.com', 'Aut dicta esse beata', 'Ipsam ea aspernatur ', '75715', '+1 (705) 193-1234', 31, 18.00, 'tr_txMTcNdvt2', '2025-05-11 10:51:21'),
(132, 'Brennan', 'Mason', '1992-05-11 00:00:00', 'demo@user.com', 'Sunt perferendis Na', 'Duis sed totam ab ma', '61447', '+1 (542) 437-1251', 31, 18.00, 'tr_3WL5qHqaJf', '2025-05-11 10:53:13'),
(133, 'Steel', 'Flores', '1970-04-24 00:00:00', 'demo@user.com', 'Cupiditate voluptate', 'Excepteur sequi ab q', '18028', '+1 (866) 516-7351', 31, 18.00, 'tr_QVL3MRURNS', '2025-05-11 11:23:34'),
(134, 'Ebony', 'Curtis', '1987-02-12 00:00:00', 'demo@user.com', 'Iste nisi blanditiis', 'Ea consequuntur hic ', '72407', '+1 (595) 923-6349', 31, 18.00, 'tr_GAeBsTUxdn', '2025-05-11 12:35:14'),
(137, 'Caryn', 'Hogan', '2007-11-18 00:00:00', 'demo@user.com', 'Sequi ut in doloremq', 'Est blanditiis mole', '22301', '+1 (436) 729-1906', 31, 455.00, 'tr_VRPZK4vVK2', '2025-05-12 03:27:51'),
(141, 'Dieter', 'Mcguire', '1984-10-06 00:00:00', 'demo@user.com', 'Ea iste qui necessit', 'Labore qui non ipsam', '44242', '+1 (752) 486-5294', 31, 10.00, 'tr_rstfkzAMzp', '2025-05-12 03:46:23'),
(142, 'Tanya', 'Owen', '2017-05-06 00:00:00', 'demo@user.com', 'Ullamco illo quis et', 'Porro tempore moles', '44492', '+1 (426) 972-5794', 31, 10.00, 'tr_Dm9Pu8MBhh', '2025-05-12 03:48:48'),
(144, 'Halla', 'Greer', '2017-07-16 00:00:00', 'haarlemfestivalrecovery1@gmail.com', 'Officia veritatis nu', 'In ratione pariatur', '52894', '+1 (275) 533-6225', 6, 18.00, 'tr_7wedRTADCy', '2025-05-12 04:06:59'),
(146, 'Herrod', 'Gilmore', '1992-07-26 00:00:00', 'haarlemfestivalrecovery1@gmail.com', 'Ea sint ullam in und', 'Distinctio Non quo ', '40373', '+1 (547) 314-6434', 6, 18.00, 'tr_GSybeWRAwD', '2025-05-14 11:49:55'),
(147, 'James', 'Mckinney', '1970-02-13 00:00:00', 'haarlemfestivalrecovery1@gmail.com', 'Pariatur Et dolor e', 'Eum voluptate exerci', '58274', '+1 (643) 562-8906', 6, 18.00, 'tr_GbeiFUmuBB', '2025-05-15 07:11:13'),
(148, 'Ocean', 'Vasquez', '1972-05-27 00:00:00', 'haarlemfestivalrecovery1@gmail.com', 'Pariatur Sit quide', 'Vero quia vero minim', '84436', '+1 (716) 456-3202', 6, 52.00, 'tr_U6neaPs325', '2025-05-15 07:20:10'),
(149, 'Blaine', 'Mcclure', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Qui blanditiis itaqu', 'Minus dignissimos et', '29919', '+1 (323) 939-2329', 6, 18.00, 'tr_H8BiMjKH6Q', '2025-05-15 10:10:34'),
(150, 'Amber', 'Knowles', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Commodo aliquam mini', 'Architecto quas dolo', '54431', '+1 (877) 668-2305', 6, 18.00, 'tr_eiqdhev8Yi', '2025-05-15 11:49:06'),
(151, 'Hollee', 'Snider', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Mollit laborum quia ', 'Quasi explicabo Et ', '22936', '+1 (501) 126-7075', 6, 90.00, 'tr_H9S5tu7Hwk', '2025-05-18 08:39:24'),
(152, 'Signe', 'Rosario', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Qui nisi ducimus pl', 'Reiciendis et fugiat', '30045', '+1 (893) 157-7364', 6, 160.00, 'tr_7P8ayJCEGP', '2025-05-18 08:43:59'),
(153, 'Christian', 'Cline', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Aspernatur sint nihi', 'Rerum sint qui simil', '93321', '+1 (363) 289-5394', 6, 18.00, 'tr_VAsBmv9QWE', '2025-05-18 09:13:32'),
(154, 'Mohammad', 'Duffy', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Quam eaque quia adip', 'Qui cumque natus ven', '63397', '+1 (905) 136-7571', 6, 18.00, NULL, '2025-05-21 05:01:04'),
(155, 'Barclay', 'Alford', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Consectetur nihil n', 'Atque laborum error ', '43759', '+1 (415) 885-9056', 6, 280.00, 'tr_iaB5j6Su8M', '2025-05-21 06:22:15'),
(156, 'Regan', 'Walton', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Ea incididunt dolori', 'Non sit voluptatem ', '86472', '+1 (957) 682-8637', 6, 18.00, NULL, '2025-05-21 08:31:56'),
(157, 'Geraldine', 'Baldwin', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Aspernatur ex incidu', 'Illo fugiat culpa ', '64450', '+1 (541) 188-1473', 6, 20.00, NULL, '2025-05-21 08:47:28'),
(158, 'Alika', 'Keith', NULL, 'haarlemfestivalrecovery1@gmail.com', 'In accusantium ratio', 'Explicabo Natus rep', '45005', '+1 (823) 403-8462', 6, 18.00, NULL, '2025-05-21 08:51:22'),
(159, 'Ivory', 'Lynn', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Fugiat pariatur Aut', 'Aut voluptate eos ne', '45556', '+1 (137) 878-8418', 6, 18.00, NULL, '2025-05-21 08:52:29'),
(160, 'Mallory', 'Frank', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Eaque quia mollitia ', 'Fugit autem eaque v', '92010', '+1 (458) 706-8118', 6, 18.00, NULL, '2025-05-21 08:53:27'),
(161, 'Ahasanul Rabbi', 'Khan', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Rietdekkerstraat 24', 'Netherlands', '1445 KG', '0684611580', 6, 17.00, NULL, '2025-05-28 10:16:25'),
(163, 'Ahasanul demo', 'Khan', NULL, 'demo@user.com', 'Rietdekkerstraat 24', 'Netherlands', '1445 KG', '0684611580', 31, 17.00, NULL, '2025-05-28 10:30:29'),
(164, 'Ahasanul ', 'Khan', '1994-06-21 00:00:00', 'demo@user.com', 'Rietdekker 24', 'Netherlands', '1445 KG', '0684611580', 31, 17.00, 'Paid', '2025-05-28 12:05:04'),
(165, 'Ahasanul Rabbi', 'Khan', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Rietdekker 24', 'Netherlands', '1445 KG', '0684611580', 6, 17.00, 'tr_LZxff6ZFxR', '2025-05-28 13:49:34'),
(166, 'Ahasanul Rabbi', 'Khan', NULL, 'haarlemfestivalrecovery1@gmail.com', 'Rietdekker 24', 'Netherlands', '1445 KG', '0684611580', 6, 17.00, 'tr_B9dCQt9NCr', '2025-05-28 13:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `orders_item`
--

CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders_item`
--

INSERT INTO `orders_item` (`id`, `order_id`, `product_id`, `user_id`, `qty`, `price`) VALUES
(117, 133, 81, 31, 1, 18.00),
(118, 134, 81, 31, 1, 18.00),
(119, 137, 55, 31, 1, 455.00),
(120, 141, 66579, 31, 1, 10.00),
(121, 142, 66579, 31, 1, 10.00),
(122, 144, 81, 6, 1, 18.00),
(124, 146, 81, 6, 1, 18.00),
(125, 147, 81, 6, 1, 18.00),
(126, 148, 81, 6, 1, 18.00),
(127, 148, 83, 6, 1, 34.00),
(128, 149, 81, 6, 1, 18.00),
(129, 150, 81, 6, 1, 18.00),
(130, 151, 66587, 6, 3, 90.00),
(131, 152, 66588, 6, 4, 160.00),
(132, 153, 81, 6, 1, 18.00),
(133, 154, 81, 6, 1, 18.00),
(134, 155, 81, 6, 2, 36.00),
(135, 155, 83, 6, 2, 68.00),
(136, 155, 66589, 6, 2, 120.00),
(137, 155, 58, 6, 2, 36.00),
(138, 155, 59, 6, 1, 20.00),
(139, 156, 81, 6, 1, 18.00),
(140, 157, 59, 6, 1, 20.00),
(141, 158, 81, 6, 1, 18.00),
(142, 159, 81, 6, 1, 18.00),
(143, 160, 81, 6, 1, 18.00),
(144, 161, 81, 6, 1, 17.00),
(145, 163, 81, 31, 1, 17.00),
(146, 164, 81, 31, 1, 17.00),
(147, 165, 81, 6, 1, 17.00),
(148, 166, 81, 6, 1, 17.00);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `headerImg` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `headerImg`, `title`, `description`) VALUES
(1, 401, 'Visit Haarlem', 'Haarlem, one of the most attractive destinations in the Netherlands, is just at 15 minutes by train away from Amsterdam. This small city is the capital of the province of North Holland. It is also a great destination to walk around. In it, you can find the beauty of Amsterdam but without those huge crowds of people.\r\n'),
(2, 405, 'The Festival', 'The Festival is an unique event in the old town of Haarlem.  A Line-up with amazing artists and crazy afterparties. It offers a wide number of options for its visitors in a Program spread over four days. From concerts to history events and food. Children activities are of course included as well. '),
(3, 206, 'History', 'Learn more about the rich and wealthy history of Haarlem'),
(4, 214, 'Museum', 'Art, History, Archeologie, whatever you like, do not miss out on Haarlems Museums.'),
(5, 339, 'Theater', 'Haarlem offers a number of theater related events in a multitude of different venues. Some venues that are worth checking out are listed here on this page. There is also a list of events which take place in the coming months.'),
(6, 338, 'Music', 'Haarlem offers a number of music related events in a multitude of different venues. Some venues that are worth checking out are listed here on this page. There is also a list of events which take place in the coming months.'),
(7, 122, 'Haarlem food', 'As breathtaking and wonderful as Haarlem is, the city has a lot to offer when it comes to food. The city is known for its variety of cuisines, both Dutch and international. Come with us and dive into our top picks that will make your belly happy while visiting Haarlem.');

-- --------------------------------------------------------

--
-- Table structure for table `pagecard`
--

CREATE TABLE `pagecard` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `opening_time` datetime DEFAULT NULL,
  `closing_time` datetime DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `adult_price` float DEFAULT NULL,
  `kids_price` float DEFAULT NULL,
  `image` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `pageId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pagecard`
--

INSERT INTO `pagecard` (`id`, `title`, `opening_time`, `closing_time`, `location`, `rating`, `adult_price`, `kids_price`, `image`, `link`, `description`, `pageId`) VALUES
(1, 'History', NULL, NULL, NULL, NULL, NULL, NULL, 402, '/page/history', NULL, 1),
(2, 'Museum', NULL, NULL, NULL, NULL, NULL, NULL, 403, '/page/museum', NULL, 1),
(3, 'Food', NULL, NULL, NULL, NULL, NULL, NULL, 404, '/page/food', NULL, 1),
(5, 'Dance', NULL, NULL, NULL, NULL, NULL, NULL, 406, '/event/danceevents', 'Six different artists will be performing in Haarlem this July 28, 29 and 30. They will be playing techno, house, dance, electronic, and trance. Don’t think twice and check out our schedule. Choose the event you like the most and get ready to spend the whole night dancing. ', 2),
(6, 'Jazz', NULL, NULL, NULL, NULL, NULL, NULL, 407, '/event/jazzevents', 'The Festival is specifally known for its Jazz events. So there will be a number of amazing Jazz artists playing some great concerts with the best atmosphere you can wish for. On Sunday, the last day of the festival, they will even play concerts for free on the Grote Markt stage.\r\nMore information on the Jazz page...', 2),
(7, 'Food', NULL, NULL, NULL, NULL, NULL, NULL, 408, '/yummy', 'If you are interested in experiencing amazing food, in the Festival we offer many special offers for you. We have partnered with some of the best restaurants in Haarlem to offer an special menu for the festival. \r\nFor more information, visit the Yummy page....', 2),
(8, 'History', NULL, NULL, NULL, NULL, NULL, NULL, 409, '/historyevent', 'Haarlem is home to many historical locations. The Haarlem festival offers several history tours which allow visitors to follow a tour guide on a stroll through history, and learn all about the history of our beautiful city.', 2),
(10, 'Haarlem Origins', NULL, NULL, 'Learn about Haarlem officially becoming a city.', NULL, NULL, NULL, 210, 'https://en.wikipedia.org/wiki/Haarlem', 'Archeologic research suggests people where living near the river “Het Spaarne” at least 3600 years before our year count. Haarlem started out as a spiritual settlement on a beach ridge, with a country road running through it that connected North- and South-Holland. \n\nAround 1500 B.C. Haarlem would grow from a small town of ghosts into the Seat of the counts of Holland. Haarlem’s  favorable location near het Spaarne led to the quick development of the city.\n\n\n\n', 3),
(11, 'Anno Haarlem', NULL, NULL, 'Experience the entire history of Haarlem.', NULL, NULL, NULL, 208, 'https://www.visithaarlem.com/ontdekken/historie/anno-haarlem/', 'Located in the basement of Haarlems town hall, the hart of the city since the 14th century, Anno Haarlem will alow you to learn about the full History of Haarlem. From the building of the St. Bavo church or “Grote kerk” to the development of Haarlem before and during the Golden age. \n\nFor more information about Anno Haarlem you can visit Haarlems tourist center the VVV at VVV Haarlem, Grote Markt 2, 2011 RD Haarlem.', 3),
(12, 'Haarlem Trivia', NULL, NULL, 'Learn some interesting trivia facts about Haarlem.', NULL, NULL, NULL, 213, 'https://haarleminsight.wordpress.com/say-hello-to-haarlem/', 'Fun Fact: The name Haarlem is believed to come from the word “Haarloheim”. This name consists of old dutch words for residence (heim or heem), high sandy ground (haar) and forest (lo). This means Haarlem was likely reffered to as the ‘residence on a high ground of sand in the forest’. ', 3),
(13, 'The Corrie ten Boom House', '2023-06-20 10:00:00', '2023-06-24 16:00:00', 'Barteljorisstraat 19, 2011 RA Haarlem', 9.2, 0, 0, 215, NULL, NULL, 4),
(14, 'Frans Hals Museum - Hof', '2023-06-20 10:00:00', '2023-06-25 17:00:00', 'Grote Heiligland 62, 2011 ES Haarlem', 8.8, 16, 0, 216, NULL, NULL, 4),
(15, 'Teylers Museum', '2023-06-20 11:00:00', '2023-06-25 17:00:00', 'Spaarne 16, 2011 CH Haarlem', 9, 15, 0, 217, NULL, NULL, 4),
(16, 'Museum Haarlem', '2023-06-19 11:00:00', '2023-06-25 17:00:00', 'Grote Heiligland 47, 2011 EP Haarlem', 7.8, 7, 0, 218, NULL, NULL, 4),
(17, 'Barrel Organ Museum', '2023-06-25 12:00:00', '2023-06-25 18:00:00', 'Kuppersweg 3, 2031 EA Haarlem', 9, 0, 0, 219, NULL, NULL, 4),
(18, 'Archeological Museum Haarlem', '2023-06-21 13:00:00', '2023-06-25 17:00:00', 'Grote Markt 18k, 2011 RD Haarlem', 8.8, 0, 0, 220, NULL, NULL, 4),
(26, 'Stadsschouwburg', NULL, NULL, 'Wilsonplein 23, 2011 VG Haarlem', 9, NULL, NULL, 345, 'https://www.theater-haarlem.nl/', 'This performing arts theater stands as a testament to the rich culture of the region, showcasing interesting and engaging plays for all kinds of audiences. The seats are comfortable with plenty of leg-room. There is an in-house dining area too, to enhance the experience.', 5),
(27, 'Philharmonie', NULL, NULL, 'Lange Begijnstraat 11, 2011 HH Haarlem', 9, NULL, NULL, 340, 'https://www.theater-haarlem.nl/', 'A atmospheric concert hall which offers performances and concerts from classical quatetts to rock bands and ballet. The varied programme with also non-dutch events appeals to many music lovers.', 5),
(28, 'Theater Liefde', NULL, NULL, 'Begijnhof 10, 2011 HE Haarlem', 9, NULL, NULL, 347, 'https://theaterdeliefde.nl/agenda/', 'Cabaret, music and literary performances are on the program here. Also there is room for talk shows and children/s theatre. The theatre has a connecting function in Haarlem and in the neighbourhood and is also available as a rehearsal space for choirs and amateur theatre companies.', 5),
(29, 'Bencha Theater', NULL, NULL, 'Westerhoutstraat 8, 2012 JR Haarlem', 9, NULL, NULL, 341, 'https://www.benchatheater.nl/en', 'A theater with a solid reputation in the Netherlands and abroad, producing theatrical, colorful and original acts and performances in cutting-edge, contemporary circus style. Spectacular balancing acts and aerial acrobatics merge effortlessly with dance and music.', 5),
(30, 'Patronaat', NULL, NULL, 'Zijlsingel 2, 2013 DN Haarlem', 9, NULL, NULL, 346, 'https://patronaat.nl/', 'What started as a Catholic boys\' school has grown since 1984 into a Dutch core stage with hundreds of activities and 130,000 visitors per year, more than 300 club members and dozens of partners in the city. With four halls, rehearsal rooms, festivals and productions at nine external locations, Patronaat is much more than just a stage: it fulfills multiple roles in the chain of talent development and pop culture.', 6),
(31, 'Slachthuis', NULL, NULL, 'Rokplein 6, 2033 DK Haarlem', 9.4, NULL, NULL, 344, 'https://slachthuishaarlem.nl/', 'Slaughterhouse is the music factory of Haarlem. It is a place for all musicians to work, whether you are a professional or a beginner. We have various sizes of rehearsal and teaching rooms, but also two sound studios, a vinyl press for pressing small vinyl runs, a screen printing machine for printing merchandise, an old-fashioned button machine and, last but not least, a stage.', 6),
(32, 'Philharmonie', NULL, NULL, 'Lange Begijnstraat 11, 2011 HH Haarlem', 9, NULL, NULL, 340, 'https://www.theater-haarlem.nl/', 'A atmospheric concert hall which offers performances and concerts from classical quatetts to rock bands and ballet. The varied programme with also non-dutch events appeals to many music lovers.', 6),
(33, 'Blues Club', NULL, NULL, 'Korte Verspronckweg 7, 2023 BS Haarlem', 9.6, NULL, NULL, 342, 'https://en.haarlembluesclub.nl/', 'We organize a concert at least once a month, usually with the exception of summer months.\n\nExpect a relaxed, easy-going atmosphere here with\n\na line up of often internationally touring acts.\n\n​\n\nThese concerts take place on either Friday, Saturday or Sunday, unless stated otherwise.', 6),
(34, 'Nieuwe Kerk', NULL, NULL, 'Klein Heiligland 84, 2011 EJ Haarlem', 7, NULL, NULL, 343, 'https://www.nieuw-apostolische-kerk.nl/', 'The Nieuwe Kerk (1649) in Haarlem is one of the most special church buildings built for Protestant worship in the Republic of the Netherlands after the Reformation. The strict, classicist design is by Jacob van Campen, who was commissioned by the Haarlem city council to make a church building to replace the dilapidated and cramped Gothic Sint Annakapel. The tower (1613), built in the decorative style of the Dutch Renaissance by city architect Lieven de Key, had to remain.', 6),
(35, 'Welcome to het balletje', NULL, NULL, NULL, NULL, NULL, NULL, 123, NULL, 'The Dutchies don\'t take as much pride in their kitchen as the Spanish or Italians do. But <b>Restaurant Balletje</b> has the mission to prove everybody wrong. Balletje is a small & cozy restaurant. Perfect for families. It serves traditional Dutch food made with homemade ingredients and lots of love. Definitely a place to check out on your visit to Haarlem!', 7),
(36, 'The food itself', NULL, NULL, NULL, NULL, NULL, NULL, 124, NULL, 'The restaurant specialises in making meatballs as most nostalgic and iconic center piece of Dutch cuisine. The meals are traditionally prepared with a little twist. Cooked with all Dutch ingredients and spices. A place to show Haarlem\'s visitors all our beauties and marbles. <b>LEKKER!</b>', 7),
(37, 'Location', NULL, NULL, NULL, NULL, NULL, NULL, 1, '<u class=\"link\">Learn more</u> about Balletje by checking their website.', 'Balletje is situated in the fancy boutique street Kleine Houtstraat - conveniently in the city centre! It welcomes people from all ages to come and enjoy a beautiful feast.', 7),
(38, 'A bite from all over the world!', NULL, NULL, NULL, NULL, NULL, NULL, 125, NULL, 'Haarlem is for everyone. It is such a diverse city that you can meet welcoming people from every corner of our\r\n                world.</p>\r\n            <p>Naturally, you can find a variety of <b>international cuisines</b> - from exotic to surprising. </p>\r\n            <p>So. when travelling to Haarlem, why not expanding your knowledge about gastronomy? 👩🏻‍🍳</p>\r\n            <p>Here are some of our top picks that guarantee to make you and your family happy on your way to exploring new things.', 7),
(39, 'De lachende Javaan', NULL, NULL, NULL, NULL, NULL, NULL, 126, '<u class=\"link\">Learn more</u> about this restaurant', '<p>Indonesian</p>\r\n                    <ul>\r\n                        <li>Specialised in “Rijstaffel” <b>(shared dining)</b></li>\r\n                        <li>Quality of Asian food</li>\r\n                        <li>Artistic with culinary culture</li>\r\n                    </ul>', 7),
(40, 'Abay Blue Nile Taste', NULL, NULL, NULL, NULL, NULL, NULL, 127, '<u class=\"link\">Learn more</u> about this restaurant', '<p>Ethiopian</p>\r\n                    <ul>\r\n                        <li>Homemade food made with love</li>\r\n                        <li>Perfect for family gatherings</li>\r\n                        <li>Affordable & authentic</li>\r\n                    </ul>', 7),
(41, 'Little Jamaica', NULL, NULL, NULL, NULL, NULL, NULL, 128, '<u class=\"link\">Learn more</u> about this restaurant', '<p>Caribean/Jamaican</p>\r\n                    <ul>\r\n                        <li>Soul food for everybody</li>\r\n                        <li>Healthy and delicious choice</li>\r\n                        <li>The jerk chicken & Jamaican patties are a “must-try”</li>\r\n                    </ul>', 7),
(42, 'Jopen - brewery & restaurant', NULL, NULL, NULL, NULL, NULL, NULL, 129, NULL, 'Haarlem is the capital of the North Holland for a good reason. As such, it is loaded with the heavy task to\r\n                represent the traditional cuisine from this important historical region. </p>\r\n            <p><b>Beer🍺 </b> is an important part of the Dutch culture. Fortunately, you can find a wide variery of refreshing beers\r\n                at Jopen - <b>the only brewery in the city that still makes traditional Haarlem beers.</b>', 7),
(43, 'The assortiment...', NULL, NULL, NULL, NULL, NULL, NULL, 130, NULL, 'At Jopen you can find all sorts of beers to please your taste buds. From <b>lagers</b> to <b>ales</b>,\r\n                <b>pilseners</b> to IPAs - Jopen can offer <u>everything</u>. Every Jopen beer offered is <b>brewed on the location</b>,\r\n                maybe even while you are enjoying it. The kettles are right in front of you.\r\n            </p>\r\n            <p>Besides all types of beer, you can also taste all flavours of beer. Jopen makes craft beers in combination with\r\n                all sorts of aromas and ingrediends. No matter if you like <b>fruity beers </b>🍓, <b>chocholatelly notes</b> 🍫 or\r\n                <b>oak scent </b>🌲- Jopen has <b>everything for everybody!</b>', 7),
(44, 'Why Jopen?', NULL, NULL, NULL, NULL, NULL, NULL, 131, NULL, '<li>Jopen still uses beer repice from 1407! 📜</li>\r\n                <li>Haarlem city recognize Jopen as a <b>tradition keeper</b></li>\r\n                <li>Every beer is brewed on the <b>location</b></li>\r\n                <li>The building is <b>the only church in the Netherlands that became a brewery</b></li>\r\n                <li>A variety of tastes</li>\r\n                <li>No Haarlemmer will ever say a bad word about Jopen</li>\r\n                <li>Jopen has 2 silver medals🥈 from the <b>World Beer Championship</b></li>', 7),
(45, 'Location', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'Located in the city centre, Jopen is open everyday to welcome all tourists to our beautiful city. Enter this old\r\n                church (where beer is the new religion), grab yourself a fresh pint and enjoy a delicious bite.</p>\r\n            <p><u><b>Learn more</b></u> about Jopen by checking their website.', 7);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `restaurantID` int(11) NOT NULL,
  `sessionID` int(11) NOT NULL,
  `seats` int(11) NOT NULL,
  `date` datetime(6) NOT NULL,
  `request` varchar(500) DEFAULT NULL,
  `price` double NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `name`, `restaurantID`, `sessionID`, `seats`, `date`, `request`, `price`, `status`) VALUES
(66574, 'asdasd', 4, 7, 10, '2023-06-26 17:00:00.000000', 'asdasd', 10, 0),
(66575, 'Home', 4, 7, 10, '2023-06-26 17:00:00.000000', 'asdasd', 20, 0),
(66576, 'Home', 4, 7, 10, '2023-06-26 17:00:00.000000', 'asdasd', 30, 0),
(66577, 'Home', 4, 7, 10, '2023-06-26 17:00:00.000000', 'asdasd', 30, 1),
(66578, 'Home', 4, 7, 10, '2023-06-26 17:00:00.000000', 'None', 20, 1),
(66579, 'Demo User', 4, 7, 9, '2023-06-26 17:00:00.000000', 'ok', 10, 1),
(66580, 'Demo User', 4, 7, 10, '2023-06-26 17:00:00.000000', 'j,,k,', 10, 1),
(66581, 'Demo User', 4, 7, 10, '2023-06-26 17:00:00.000000', 'ok', 10, 1),
(66582, 'Demo User', 4, 7, 10, '2023-06-26 17:00:00.000000', 'ok', 10, 1),
(66583, 'Demo User', 4, 7, 1, '2023-06-26 17:00:00.000000', 'test 1', 10, 1),
(66584, 'Demo User', 4, 7, 1, '2023-06-26 17:00:00.000000', 'okkookokokok', 10, 1),
(66585, 'Demo User', 4, 7, 1, '2023-06-26 17:00:00.000000', 'vgfvgf', 10, 1),
(66586, 'gb  ', 4, 7, 1, '2023-06-26 17:00:00.000000', 'gg gf', 10, 0),
(66587, 'Malik Sanford', 4, 8, 3, '2023-06-28 19:00:00.000000', 'Occaecat excepturi c', 30, 1),
(66588, 'Ian Banks', 4, 8, 4, '2023-06-26 19:00:00.000000', 'Aut voluptas eu nequ', 40, 1),
(66589, 'Carissa Hood', 4, 8, 6, '2023-06-27 19:00:00.000000', 'Et nihil reprehender', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `cuisine` varchar(100) NOT NULL,
  `stars` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `image1` int(11) NOT NULL,
  `image2` int(11) NOT NULL,
  `image3` int(11) NOT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `location`, `description`, `cuisine`, `stars`, `email`, `phonenumber`, `image1`, `image2`, `image3`, `seats`) VALUES
(4, 'Erica Lawrence', 'In in deserunt dolor', 'A restaurant is a place where people enjoy. ', 'Eius voluptate molli', 3, 'kokoqotan@mailinator.com', '+1 (716) 721-2086', 463, 464, 465, 10),
(5, 'Leah Skinner', 'Deserunt eveniet te', 'Illum inventore ull yuddkk sda sadfk wqeqeqw dfoe', 'Fugiat incididunt l', 1, 'qyhapepuxa@mailinator.com', '+1 (711) 328-6835', 540, 541, 542, 37);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Customer'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_items`
--

CREATE TABLE `shopping_cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `uuid` binary(16) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`uuid`, `status`) VALUES
(0x0197fce7d44e45e995c895fb0ab3fbf7, 'not scanned'),
(0x08f1a653ab9c4a23a25993c59ce560c2, 'not scanned'),
(0x0b749402b53e493f88be9768a4956369, 'not scanned'),
(0x0d0b909da17f41bbbd83371849b15ca7, 'not scanned'),
(0x0dd42739f7a54d4a97f183344024e443, 'not scanned'),
(0x15b299ea26fd4de8851e7c64d76fb325, 'not scanned'),
(0x19a0ffed69aa4d4288c220bceb1d4114, 'not scanned'),
(0x1a5ec2b946cf488abee74ca214249071, 'not scanned'),
(0x21e86b98cd374a8482179521074ac2ee, 'not scanned'),
(0x2542535095b349068f1060d63f09afd5, 'not scanned'),
(0x27ad0f1d4f074da19e00cfe6bc39c260, 'not scanned'),
(0x2861f25ad4d64606bf9504013d9bd663, 'not scanned'),
(0x28de944bd0d049c88a31911b1e1122b2, 'not scanned'),
(0x2ec1928491394c80a86ecce5e4351965, 'not scanned'),
(0x2f8d657786544cfeb6ba5a31d2114e12, 'not scanned'),
(0x2fcf3c8d2c8f4dda8780bef857443592, 'not scanned'),
(0x32f2088eda9e45d7a9a474941e588e35, 'not scanned'),
(0x35db04d9f7ba47d0a43c58c416fcdb03, 'not scanned'),
(0x364ddd02c3d840d58cb9525f0582870f, 'not scanned'),
(0x3ab4ebb69b4c41cb8c106ca6e33392a5, 'not scanned'),
(0x3af13e939079406ba5140cce074b353d, 'not scanned'),
(0x443dd136dec74c57a1e6d8491933fae2, 'not scanned'),
(0x4fa23a732ff942bdb4a32ebef9b618e3, 'not scanned'),
(0x542bb59957884bf39f76580c622dce9f, 'not scanned'),
(0x5b171f8282ca427996ee86d2235901b2, 'not scanned'),
(0x6a3a8bcf902a4f268f668769ffadc86f, 'not scanned'),
(0x6ba7b8109dad11d180b400c04fd430c8, 'scanned'),
(0x6c37fe34c06c4293b936da73474bad37, 'not scanned'),
(0x6d1ebe8e6aaa4323b9e37f5651774e19, 'not scanned'),
(0x7246d7193dcd4d878541fe598bb6f5fc, 'not scanned'),
(0x73c8969937394f658f68f6c51dddb943, 'not scanned'),
(0x7b8d7c6669514dd8a487df2fc6abc9a3, 'not scanned'),
(0x7cd5bbbc99024be18746317e710f423c, 'not scanned'),
(0x81067e1467f441cd93ef04dd60cc666c, 'not scanned'),
(0x845d616a96614cb380a5f93f8abb6730, 'not scanned'),
(0x8dcf888b25f94d8389256ea6e2bd5b89, 'not scanned'),
(0x8f7f50c7bd834a56a86d0bc7097b6dd1, 'not scanned'),
(0x97ed28048142440abd0cd5dc8f86695a, 'not scanned'),
(0x993e42cab9e64ae486f1038674b7f04e, 'not scanned'),
(0x9ea68179f8dd44abb4b3ba90f99d34f6, 'not scanned'),
(0x9ead466d9b7445b684259e320c639231, 'not scanned'),
(0x9faa99ca834248e78e4f461dcc61656d, 'not scanned'),
(0xa88f6ad831b2496db4629c079e5ebc7d, 'not scanned'),
(0xa8b490b44df74fecb7d11aca4499e5aa, 'not scanned'),
(0xacaaf0defd054985ad086bd193dadf5d, 'not scanned'),
(0xad867e6b461f407eaa440530e01de9ad, 'not scanned'),
(0xba00a3dc57724a7eb8dc46288ad58722, 'not scanned'),
(0xbb8f00faf5bb4306ab670f059b064c08, 'not scanned'),
(0xbf30fc9044d149368d62b68cea9e0ebd, 'not scanned'),
(0xc9d48301dcd646f691b746c9b6b0b6bb, 'not scanned'),
(0xcbb45ab79fee404588fb9cc9c3816a2a, 'not scanned'),
(0xcd222ca46b334e6f93eed60b02601c69, 'not scanned'),
(0xd0bb39f9c3ee439caee8a9364879b3e2, 'not scanned'),
(0xd3c5bb5f264a4321968ebd004951d75a, 'not scanned'),
(0xd731175b310945d8a953e982e681193a, 'not scanned'),
(0xda9a99feb0e3420dbec8be0f6958ce89, 'not scanned'),
(0xdfc79e9a760b44c0b3d39a256e8cf984, 'not scanned'),
(0xe041e1b0de5c4217a0eb5a8a38da5386, 'not scanned'),
(0xe0878d633101441a9063d6e6975ed308, 'not scanned'),
(0xe14a6aba1dfb4b6995482ba333ac4e35, 'not scanned'),
(0xe34ba894aee044fba688c9750200d1f5, 'not scanned'),
(0xeac9462850df4bb7991e31de679f0f67, 'not scanned'),
(0xf12f16a538ea4225ba0ca57db508000f, 'not scanned'),
(0xf52f315ee4db447689f2caf40cf0b25d, 'not scanned'),
(0xf68e4602475e436eaf8a3e452d059f27, 'not scanned'),
(0xfba13d0dd11c4b0bb736d7e9683fbaea, 'not scanned');

-- --------------------------------------------------------

--
-- Table structure for table `ticketpass`
--

CREATE TABLE `ticketpass` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `type` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ticketpass`
--

INSERT INTO `ticketpass` (`id`, `name`, `price`, `type`, `datetime`) VALUES
(38, 'Day Pass Thursday', 125, 'dance', '2023-07-27 20:00:00'),
(39, 'Day Pass Friday', 150, 'dance', '2023-07-28 14:00:00'),
(40, 'Day Pass Saturday', 150, 'dance', '2023-07-29 14:00:00'),
(41, 'All Access Pass', 250, 'dance', '2023-07-27 20:00:00'),
(42, 'Day Pass Wednesday', 35, 'jazz', '2023-07-26 18:00:00'),
(43, 'Day Pass Thursday', 35, 'jazz', '2023-07-27 18:00:00'),
(44, 'Day Pass Friday', 35, 'jazz', '2023-07-28 18:00:00'),
(45, 'All Access Pass', 80, 'jazz', '2023-07-26 18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tourguide`
--

CREATE TABLE `tourguide` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tourguide`
--

INSERT INTO `tourguide` (`id`, `name`, `description`, `image`) VALUES
(5, 'John Willem', 'John Willem is a great personality, suitable of course for touring in the Dutch language. As a guide, she loves sightseeing and getting to meet new people from all over the world.', 201),
(6, 'Frederic', 'Frederic, is a honest ‘lad’ from United Kingdom, who will answer any sort of question to you, related of course about history. He will be touring in English and he loves as well meeting new people, and getting to know lots of different new cultures.', 202),
(7, 'Emilie Johnson', '“Please, do not hesitate asking me questions!”. That’s one of Emilie\'s most used senteces, since she really loves interacting with people, and learning from them as well. She is from South Africa and will be touring in Chinese.', 203),
(9, 'Brannon Freddie', 'Brannon is a full of energy guy, always looking on how to satisfy his customers as a tour guide he is. He prefers touring in English, even though he can as well speak fluent Chinese.', 205),
(20, 'Daniel Okoro', 'Sophia is an eco-certified guide who leads rainforest and wildlife tours in Costa Rica. She’s known for her deep knowledge of biodiversity and love for conservation.', 468),
(21, 'Sophia Ramirez', 'Daniel offers energetic, fun-packed tours through the bustling streets and hidden food spots of Lagos. He’s known for engaging with travelers and showing the real heart of the city.', 469),
(22, ' Aisha Khan', 'Aisha is a passionate historian with over 10 years of guiding experience around the Ottoman-era landmarks of Istanbul. Her storytelling blends history with local legends, making every tour unforgettable.\r\nImage:', 473);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `visible_password` varchar(191) DEFAULT NULL,
  `roleId` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `visible_password`, `roleId`, `email`, `created_at`) VALUES
(6, 'admin', '$2y$10$kr6f.F9l1apYrp4dElxOm.HMx6lDRZayjtzEv8i1.cbCqzk8Txa9C', '123123', 1, 'haarlemfestivalrecovery1@gmail.com', '2023-04-09 05:18:56'),
(7, 'customer', '$2y$10$ui8rjTkE2gaC6z7B3rFtQO7gYUV3f..OLuvTubtowGC55Sl0bGjwG', NULL, 2, 'sasacro11442w666@gmail.com', '2023-04-09 05:21:00'),
(9, 'visitor', '$2y$10$sCJHQPTsdnBnNVDTj7VhGewAPhOID0tUu/5l9VhZ4K4dbHrmRfy86', NULL, 2, 'sashabeghiu@gmail.com', '2023-04-09 05:53:56'),
(30, 'pujytotapi', 'Pa$$w0rd!', NULL, 1, 'sysy@mailinator.com', '2025-05-03 09:30:45'),
(31, 'demo_user', '$2y$10$LK/mYz3x1//RP1ZNgiDuYe/.GXPcfbBbblqFgaFliTXwITc1i/.TW', NULL, 2, 'demo@user.com', '2025-05-05 09:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `type` varchar(100) NOT NULL,
  `image` int(11) NOT NULL,
  `headerImg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `name`, `description`, `type`, `image`, `headerImg`) VALUES
(1, 'Club Stalker', 'Club Stalker was a disco in the old center of Haarlem . The business opened in 1983 and closed in 2019.\r\nThe building used to be a warehouse , where Felix van der Eerden opened Club Stalker in 1983 , at a time when the nightlife in the big cities was not much. The name was taken from the film Stalker by Andrei Tarkovsky. \r\nThe club played almost all kinds of electronic music : it started with New Wave and Postpunk , then House , Hip Hop , UK Garage and Drum and Bass and later mainly Minimal and Techno . It was also the first club outside the RoXY where DJ Joost van Bellen played. Because of the programming, Stalker was regarded as one of the better nightclubs in the Netherlands.\r\n\r\nYou can find us at Kromme Elleboogsteeg 20, 2011 TS Haarlem. We are open Thursday to Sunday 11pm to 5am. Our contact number 023 531 4652.', 'dance', 1, 19),
(2, 'Caprera Openluchttheater', 'In 1948, an open-air theater was built at Hoge Duin and Daalsweg 2 in Bloemendaal, to a design by civil servant A. Bos, beautifully situated in the dunes. This makes it attractive not only during performances but also as a walking park.\r\nThe number of seats is approximately 1000 and the playing surface is 30 meters wide and 15 meters deep.\r\nThe theater opened on September 1, 1948 with a performance of &quot;Don Quixote at the wedding of Kamacho&quot; by Pieter Langendijk, directed by Louis Saalborn . The players came from amateur groups in the area.\r\n\r\nYou can find us at Hoge Duin en Daalseweg 2, 2061 AG Bloemendaal. Our contact number 023 525 0050.', 'dance', 2, 20),
(3, 'Jopenkerk', 'Jopen is a beer brewery from Haarlem, Netherlands. Jopen&#039;s beer is a result of the work of Stichting Haarlems Biergenootschap, which was founded in 1992. The mission of the Biergenootschap is to re-create traditional Haarlem beers and bring them to the commercial market. Two recipes were found in the Haarlem city archives that were used as a foundation for two initial beers. The first one was a recipe from 1407; the recreation of this was named Koyt, a gruit beer.\r\nIn December 1996, the commercial company Jopen BV acquired the beer. The name Jopen refers to the 112 litre beer barrels that were used in early times to transport the Haarlem beer. Until the end of 1996 Jopen beer was brewed in the Halve Maan brewery in Hulst, after that it was made in the La Trappe brewery in Berkel-Enschot.\r\n\r\nYou can find us at Gedempte Voldersgracht 2, 2011 WD Haarlem. We are open Monday to Sunday from 10am to 1am. Our contact number 023 533 4114.', 'dance', 3, 21),
(4, 'Lichtfabriek', 'The Lichtfabriek in Haarlem is the perfect location for business events such as trade fairs, conferences, staff parties, company presentations or meetings. Why? All our event spaces can be fully customized , the industrial look &amp; feel provides a unique experience and we have 50 free guarded parking spaces in front of the door. Everything is possible and we always think along with you. Since the covid-19 measures have come into effect, we have greatly reduced our rates for photoshoots and TV and film productions. Curious about the possibilities?\r\n\r\nYou can find us at Energieplein 73, 2031 TC Haarlem. We are open Monday to Friday 9am to 5pm. Our contact number 023 303 0500.', 'dance', 4, 22),
(5, 'Club Ruis', 'Club Ruis welcomes you to the old part of Haarlem. Club Ruis, on the Grote Markt, is the ideal location in the center of Haarlem for lunch, dinner or just a drink. Next to the Café on the ground floor, there is a restaurant on the first floor where you can dine with groups of 10 people or more. You have a magnificent view over the square and the town hall. The attic of Club Ruis is very suitable for business meetings, such as a meeting location, but also for a party or private dining. \r\n\r\nYou can find us at Smedestraat 31, 2011 RE Haarlem. We are open Friday to Sunday 11pm to 5am. Our contact number 023 743 5914.', 'dance', 5, 23),
(6, 'XO The Club', 'Grand Café XO welcomes you to the old part of Haarlem. XO, on the Grote Markt, is the ideal location in the center of Haarlem for lunch, dinner or just a drink. Next to the Café on the ground floor, there is a restaurant on the first floor where you can dine with groups of 10 people or more. You have a magnificent view over the square and the town hall. The attic of XO is very suitable for business meetings, such as a meeting location, but also for a party or private dining. All rooms as described above can be booked separately.\r\n\r\nYou can find us at Grote Markt 8, 2011 RD Haarlem. We are open Thursday to Sunday 11pm to 5am. Our contact number 023 551 1350.', 'dance', 6, 24),
(7, 'Grote Markt', 'Perhaps the best known of all of Haarlem’s markets is the Grote Markt (which translates as great market). Located right under the Bavo Cathedral and ringed by terraces and bars, it’s certainly picturesque and entertaining. All manner of things are sold here – from artisanal breads and pies to flowers and plants. And of course clothes, shoes, trinkets and accessories are in abundance. There’s something to please everyone – and every wallet – at this historic Haarlem market.\nMarkets are held on the Grote Markt square on Mondays and Saturdays, from 09h00 to 16h00.\n\n', 'jazz', 55, 56),
(8, 'Patronaat Main Hall', 'Stage 1 is the largest venue in Patronaat and has already seen many (inter)national artists and events. The spacious hall leads to the stage via a few steps, so that there is a clear view of the wide stage from anywhere in the hall. There is also a balcony that is accessible from both the hall and the stairwell behind it.\n\nStage 1 has a spacious stage with modern and high-quality facilities in the field of light and sound. The regular standing capacity is 995, but during dance productions we use a maximum capacity of 850.\n\nThere are a total of two bars in Stage 1; one wide bar in the back of the room and a well-equipped bar on the balcony. The toilets are accessible from both the hall and the balcony via the adjacent stairwell.', 'jazz', 57, 60),
(9, 'Patronaat Second Hall', 'Stage 2 is Patronaat\'s second room and has both the more intimate qualities of a smaller room and the ambiance of an underground club. Stage 2 is reached via the central foyer, after which one enters the spacious balcony (total area 104m2). From this balcony there is an all-round view of the stage and the hall itself can be reached via a connected wide staircase. Stage 2 has a spacious stage with modern and high-quality facilities in the field of light and sound.\n\nStage 2 has two bars, one on the balcony and one in the hall. Connected toilets are accessible through the hall.', 'jazz', 58, 60),
(10, 'Patronaat Third Hall', 'Patronaat Stage 3 used to be known as \'the Café\', but has a completely new look after a thorough renovation. On Fridays and Saturdays, this room hosts the Haarlem nightclub CLUB3. The room has all modern and high-quality facilities in the field of light and sound.\n\nStage 3 has one bar, and the Boiler and Expo above can also be used. These smaller, stylish spaces can be used for DJs or as an exhibition space.', 'jazz', 59, 60),
(45, 'ASDASDxxxxxff', 'ASDxxxcfff e', 'jazz', 520, 521),
(46, 'sad', 'asdasd', 'dance', 522, 523);

-- --------------------------------------------------------

--
-- Table structure for table `verification_code`
--

CREATE TABLE `verification_code` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `verification_code`
--

INSERT INTO `verification_code` (`id`, `code`, `userId`, `timestamp`) VALUES
(16, 235979, 7, '2025-04-28 10:08:53'),
(17, 520131, 7, '2025-04-29 04:57:04'),
(18, 174055, 7, '2025-04-29 04:57:09'),
(19, 269191, 7, '2025-04-29 04:57:57'),
(20, 629635, 6, '2025-04-29 04:58:08'),
(21, 335559, 6, '2025-04-29 04:58:31'),
(22, 986796, 6, '2025-04-29 04:59:00'),
(23, 290543, 6, '2025-04-29 04:59:50'),
(24, 786095, 6, '2025-04-29 04:59:55'),
(25, 692060, 6, '2025-04-29 04:59:57'),
(26, 981520, 6, '2025-04-29 05:00:16'),
(27, 496863, 6, '2025-04-29 05:02:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`),
  ADD KEY `artistId` (`artistId`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `headerImg` (`headerImg`),
  ADD KEY `thumbnailImg` (`thumbnailImg`),
  ADD KEY `logo` (`logo`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `food_session`
--
ALTER TABLE `food_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantid` (`restaurantid`);

--
-- Indexes for table `history_event`
--
ALTER TABLE `history_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`),
  ADD KEY `history_event_ibfk_2` (`tourguideID`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `music_event`
--
ALTER TABLE `music_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artist` (`artist`),
  ADD KEY `venue` (`venue`),
  ADD KEY `image` (`image`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_id` (`order_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `headerImg` (`headerImg`);

--
-- Indexes for table `pagecard`
--
ALTER TABLE `pagecard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`),
  ADD KEY `pageId` (`pageId`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_restaurantdid` (`restaurantID`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image1` (`image1`),
  ADD KEY `image2` (`image2`),
  ADD KEY `image3` (`image3`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart_items`
--
ALTER TABLE `shopping_cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `ticketpass`
--
ALTER TABLE `ticketpass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tourguide`
--
ALTER TABLE `tourguide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role` (`roleId`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image` (`image`),
  ADD KEY `image_2` (`image`),
  ADD KEY `FK_VenueHeaderImg` (`headerImg`);

--
-- Indexes for table `verification_code`
--
ALTER TABLE `verification_code`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `food_session`
--
ALTER TABLE `food_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `history_event`
--
ALTER TABLE `history_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=552;

--
-- AUTO_INCREMENT for table `music_event`
--
ALTER TABLE `music_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `orders_item`
--
ALTER TABLE `orders_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pagecard`
--
ALTER TABLE `pagecard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66590;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shopping_cart_items`
--
ALTER TABLE `shopping_cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=383;

--
-- AUTO_INCREMENT for table `ticketpass`
--
ALTER TABLE `ticketpass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tourguide`
--
ALTER TABLE `tourguide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `verification_code`
--
ALTER TABLE `verification_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food_session`
--
ALTER TABLE `food_session`
  ADD CONSTRAINT `FK_restaurant_id` FOREIGN KEY (`restaurantid`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `orders_item`
--
ALTER TABLE `orders_item`
  ADD CONSTRAINT `fk_orders_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_restaurantdid` FOREIGN KEY (`restaurantID`) REFERENCES `restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shopping_cart_items`
--
ALTER TABLE `shopping_cart_items`
  ADD CONSTRAINT `fk_shopping_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`);

--
-- Constraints for table `verification_code`
--
ALTER TABLE `verification_code`
  ADD CONSTRAINT `fk_userId` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

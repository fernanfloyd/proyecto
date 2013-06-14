-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-04-2013 a las 17:30:26
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE IF NOT EXISTS `acceso` (
  `ID_ACCESO` int(11) NOT NULL AUTO_INCREMENT,
  `FECHA` datetime NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `NICK` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_ACCESO`,`FECHA`,`ID_USUARIO`),
  UNIQUE KEY `UK_USUARIOS` (`NICK`),
  KEY `FK_ACCESO_USUARIOS` (`ID_USUARIO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `acceso`
--

INSERT INTO `acceso` (`ID_ACCESO`, `FECHA`, `ID_USUARIO`, `NICK`) VALUES
(1, '2013-04-15 13:55:42', 5, 'dm9'),
(4, '2013-04-15 17:00:22', 9, 'fperez'),
(3, '2013-04-15 16:41:01', 6, 'marinadm9'),
(5, '2013-04-15 17:02:46', 11, 'vero');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actores`
--

CREATE TABLE IF NOT EXISTS `actores` (
  `ID_ACTOR` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE_APE` varchar(50) NOT NULL,
  `NACIONALIDAD` varchar(30) NOT NULL,
  `FECHA_NAC` date NOT NULL,
  `DESCRIPCION` varchar(140) NOT NULL,
  `CARRERA` varchar(2000) NOT NULL,
  `IMAGEN` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_ACTOR`),
  UNIQUE KEY `UK_ACTORES` (`NOMBRE_APE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `actores`
--

INSERT INTO `actores` (`ID_ACTOR`, `NOMBRE_APE`, `NACIONALIDAD`, `FECHA_NAC`, `DESCRIPCION`, `CARRERA`, `IMAGEN`) VALUES
(1, 'Christian Bale', 'Reino Unido', '1973-01-30', 'Christian Bale (Haverfordwest, Gales, 30 de enero de 1974) actor de cine y televisión británico. Ganador de los premios Óscar y Globo de Oro', 'Christian Bale (Haverfordwest, Gales, 30 de enero de 1974) actor de cine y televisión británico. Ganador de los premios Óscar y Globo de Oro. Nació en la pequeña ciudad de Haverfordwest (13 000 habitantes), capital del condado de Pembrokeshire (Gales). Su padre era el activista sudafricano David Bale (1941-2003) y su madre, la británica Jenny James, trabajó en el circo como bailarina. Bale tuvo tres hermanas mayores. En el año 2000, rueda las películas Shaft: The Return y American Psycho. Cuatro años después, su papel en El maquinista, una producción española, le puso a prueba física y mentalmente a la hora de enfrentarse a uno de los roles más difíciles de su carrera hasta el momento. Su gran oportunidad llegó con Batman Begins (2005). En 2006 participó la película The Prestige junto a Hugh Jackman y Michael Caine, dirigida por Christopher Nolan. En el año 2007 participa en Rescue Dawn, I''m Not There y 3:10 to Yuma y en 2008 vuelve al papel de Batman en The Dark Knight, de la cual se han tenido muy buenas impresiones y ha roto récord de taquilla en Estados Unidos, al lograr más de 500 millones de dólares. Sus más recientes trabajos han sido en las cintas Terminator Salvation, donde interpretó a John Connor y Enemigos públicos, como Melvin Purvis, el Agente del FBI, al que J. Edgar Hoover encargó la cacería del famoso asaltante John Dillinger, interpretado por Johnny Depp. En el 2010, su carrera llegó a la cúspide cuando ganó el Óscar, el Globo de Oro y el Premio del Sindicato de Actores al Mejor Actor de Reparto por su interpretación de Dicky Eklund en la película The Fighter, interpretación que fue totalmente aclamada tanto por el público como por la crítica especializada. En 2012 interpreta por tercera y última vez a Batman / Bruce Wayne en The Dark Knight Rises, sellando así el final de la trilogía de Christopher Nolan del justiciero oscuro.', 'Christian_Bale.jpg'),
(2, 'Anne Hathaway', 'EEUU', '1982-11-12', 'Anne Hathaway,(Brooklyn, Nueva York, Estados Unidos, 12 de noviembre de 1982), es una actriz de cine estadounidense.', 'Anne Hathaway, (Brooklyn, Nueva York, Estados Unidos, 12 de noviembre de 1982), es una actriz de cine estadounidense. Fue elegida como Mia Thermopolis en la película de comedia familiar de Disney The Princess Diaries (2001), con la que su carrera cobró impulso. Durante los siguientes tres años, Hathaway continuó protagonizando películas familiares, retomando el papel de Mia Thermopolis en la secuela, y como personaje principal en Ella Enchanted (ambas de 2004). Interesada en otros proyectos, Hathaway comenzó una transición de carrera con papeles de reparto en Caos y Brokeback Mountain (ambas de 2005). Posteriormente, fue coprotagonista junto a Meryl Streep en The Devil Wears Prada (2006) y apareció en Becoming Jane (2007) como la escritora Jane Austen. En 2008, obtuvo varios reconocimientos por su papel protagonista en la película La boda de Rachel, siendo nominada para el Premio Óscar a la mejor actriz. En 2009 protagonizó al lado de Kate Hudson la película Guerra de Novias. En 2010, protagonizó los éxitos de taquilla Valentine''s Day y Alicia en el país de las maravillas. En 2012 interpretó a (Gatúbela (Catwoman) - Selina Kyle) la famosa rival y posteriormente aliada de (Bruce Wayne - Batman) Christian Bale en The Dark Knight Rises la cual fue la tercera y última entrega de la trilogía de Batman. En 2012 protagonizó la película musical ''Los Miserables'' interpretando a Fantine, actuando junto a Hugh Jackman y Russell Crowe entre otros, recibiendo el Globo de Oro y el Óscar a la mejor actriz de reparto. Su estilo de actuación ha sido comparado con Judy Garland y Audrey Hepburn.1 Hathaway cita a Hepburn como una de sus actrices favoritas2 y a Streep como un icono.3 La revista People la nombró como una de las grandes estrellas descubiertas en 20014 y apareció por primera vez en la lista de las 50 personas más bellas del mundo de dicha revista en 2006.5 En 2011 dirigió la 83ª edición de los Premios Óscar, junto a James Franco.', 'Anne_Hathaway.jpg'),
(3, 'Tom Hardy', 'Reino Unido', '1977-09-17', 'Tom Hardy (Londres, 15 de septiembre de 1977) es un actor de cine y de teatro británico. Conocido sobre todo por Bronson (2009).', 'Tom Hardy (Londres, 15 de septiembre de 1977) es un actor de cine y de teatro británico. Es conocido sobre todo por la película Bronson (2009) en la que interpreta el papel de protagonista que da nombre a la cinta, además de sus papeles secundarios en películas como Star Trek Nemesis, Origen (Inception) y El caballero oscuro de la saga de Batman. En 2010 recibió el BAFTA a la estrella emergente. Hardy nació en Walthernnol''s y allí vivió hasta la edad de 20 años, luego se fue a Hammersmith y creció en el East Sheen de Londres. Su madre, Anni, era una artista y pintora de ascendencia católica irlandesa y su padre, Edward Chips Hardy, era escritor de comedias. Hardy estudió interpretación en el Reeds School, Tower House School, Richmond Drama School,y finalmente en el Drama Centre London. Comienza su carrera interpretando papeles en dramas bélicos, siendo famosa su interpretación del soldado John Janovec en la premiada miniserie Hermanos de sangre. Hace su debut cinematográfico de la mano de Ridley Martten Scott en el año 2001 en Black Hawk derribado. En 2006 tiene un papel secundario en la comentada película María Antonieta de Sophia Coppola y en 2008 en RocknRolla de Guy Ritchie. En 2009 interpreta el papel protagonista de Bronson. Pero posiblemente el filme que le catapulta a la fama internacional es Origen (Inception), con Leonardo di Caprio; su físico imponente y su vestimenta le lanzan como sex symbol. En 2011 participa en Tinker Tailor Soldier Spy (El topo), adaptación cinematográfica de la novela de John Le Carré, con un gran reparto encabezado por el veterano actor Gary Oldman en el papel de George Smiley, Colin Firth, John Hurt y Toby Jones, entre otros. En 2012 Hardy es el nuevo enemigo de Batman en Batman:The Dark Knight Rises, la última entrega de la trilogía sobre el citado héroe, abordada por el director Christopher Nolan. Hardy brinda una gran actuación interpretando al cerebral Bane.', 'Tom_Hardy.jpg'),
(4, 'Sylvester Stallone', 'EEUU', '1946-07-06', 'Sylvester Stallone (6 de julio, 1946) es un actor, guionista y director de cine estadounidense.', 'Sylvester Stallone (6 de julio, 1946) es un actor, guionista y director de cine estadounidense. Sylvester Stallone, apodado ''Sly'', es considerado como una de las estrellas más importantes del cine de acción de Hollywood. Ha dado vida a dos icónicos personajes del cine: Rocky Balboa, el humilde boxeador de Filadelfia que venció todos los pronósticos y ante la adversidad, se convirtió en campeón; y John Rambo, el atormentado ex boina verde veterano de la guerra de Vietnam, especializado en guerrilla, supervivencia y combate. Aparte de las sagas de Rocky y Rambo, entre sus cintas más populares se encuentran: Los Mercenarios (2010), Asesinos (1995), El Juez Dredd (1995), El especialista (1994), Demolition Man (1993), Cliffhanger (1993), Lock Up (1989), Tango y Cash (1989), Over the Top (1987) y Cobra (1986).', 'Sylvester_Stallone.jpg'),
(5, 'Arnold Schwarzenegger', 'Austria', '1947-07-30', 'Arnold Schwarzenegger (nacido el 30 de julio de 1947 en Graz, Estiria, Austria), es un exfísico-culturista, actor y político.', 'Arnold Schwarzenegger (nacido el 30 de julio de 1947 en Graz, Estiria, Austria), es un exfísico-culturista, actor y político austriaco nacionalizado estadounidense que ejerció como trigésimo octavo gobernador de California desde 2003 hasta 2011. Schwarzenegger ganó fama en todo el mundo como un icono de las películas de acción de Hollywood, conocido por sus papeles protagonistas en películas como Conan el Bárbaro, Terminator, Comando, Desafío total (El vengador del futuro en Hispanoamérica) y Depredador. Fue apodado el roble austríaco y el roble de Estiria en sus días de culturismo, Arnie durante su carrera como actor y más recientemente el Governator (una contracción de Governor y Terminator). Junto con Bruce Willis, Sylvester Stallone y Demi Moore invirtió en la cadena Planet Hollywood, aunque a comienzos del año 2000 decidió no continuar,120 porque dijo que la empresa no había tenido el éxito suficiente y que quería embarcarse en otros proyectos. Una estimación conservadora de las ganancias netas de Schwarzenegger las cifran entre cien y doscientos millones de dólares. En el transcurso de los años, invirtió mucho de su dinero por lo que es difícil estimar su fortuna, sobre todo tras la crisis económica de 2008-2010. En junio de 1997, Schwarzenegger gastó treinta y ocho millones de dólares en un jet privado. Schwarzenegger dijo una vez ''El dinero no da la felicidad. Ahora tengo cincuenta millones pero ya era feliz cuando tenía cuarenta y ocho''. También dijo: ''He conseguido muchas veces hacer un millón como hombre de negocios''.', 'Arnold_Schwarzenegger.jpg'),
(6, 'Jason Statham', 'Reino Unido', '1967-09-12', 'Jason Statham (Londres, 12 de septiembre de 1967), actor de cine británico, conocido por sus papeles en las películas de Guy Ritchie.', 'Jason Statham (Sydenham, Londres, 12 de septiembre de 1967), es un actor de cine británico, conocido por sus papeles en las películas de Guy Ritchie como Juegos, Trampas y dos Armas Humeantes, Snatch, Cerdos y Diamantes y Revólver, así como en Crank, 1 y 2, la trilogía de The Transporter, La Carrera de la Muerte, Blitz y como más reciente Los Mercenarios.\nDebido al éxito conseguido en Lock, Stock and Two Smoking Barrels, volvió a unirse con Guy Ritchie para la película Snatch: cerdos y diamantes en 2000, junto a actores como Brad Pitt, Dennis Farina y Benicio del Toro.\nDespués de Snatch actuó en Turn It Up (2000), con el rapero estadounidense Ja Rule, seguido por papeles secundarios en Fantasmas de Marte (2001), El único (2001), con Jet Li y bajo la dirección de James Wong, y en Mean Machine (2001), junto con Vinnie Jones.\nEn 2002, después de realizar papeles secundarios, obtuvo finalmente un papel principal, el de Frank Martin en El Transportador. Statham también actuó en el remake de The Italian Job. Tras realizar un cameo en Colateral (2004) y trabajar en Celular (2004), en 2005 protagonizó la primera secuela de El Transportador, El Transportador 2, Revólver (esta última película también de Guy Ritchie), y también Chaos, junto con Wesley Snipes. En 2006 protagonizó la película Crank. En 2008 protagonizó la segunda secuela de El Transportador, El Transportador 3 y el remake de La Carrera de la Muerte, y en 2009 protagonizó la secuela de Crank, Crank 2: High Voltage.\nEn 2010 coprotagonizó, junto a Sylvester Stallone, Jet Li y Dolph Lundgren, la taquillera película de acción Los Mercenarios, dirigida por Sylvester Stallone.\nEn 2011 protagonizó la película El Mecánico, dirigida por Simon West, remake de la película del mismo nombre que interpretó en 1972 Charles Bronson.\nEn 2012 protagoniza junto a Robert De Niro, Yvonne Strahovski, y Clive Owen, la película Asesinos de Élite.\nTrabajó en la secuela Los Mercenarios 2, estrenada en 2012.\n', 'Jason_Statham.jpg'),
(7, 'Sam Worthington', 'Reino Unido', '1976-08-02', 'Sam Worthington (Godalming, Surrey, Inglaterra, 2 de agosto de 1976) es un actor británico.', 'Sam Worthington (Godalming, Surrey, Inglaterra, 2 de agosto de 1976) es un actor británico.\nDespués de graduarse en 1998, Worthington realizó una producción sobre el Beso de Judas para la productora Company B en el Belvoir St Theatre.\nSiguió actuando en una serie de Australia, en películas y series de televisión, incluyendo una función, Bootmen y actuaciones en Dirty Deeds, Gettin Square (El Desquite),Somersault y Macbeth. Worthington ganó en el 2004 el Premio al Mejor Actor Principal por su papel en Somersault. Es muy conocido en Australia por su papel de Howard en la aclamada serie de televisión australiana Love My Way.\nLa carrera internacional de Worthington en el cine comenzó con una serie de pequeños papeles en Hollywood en producciones como Hart''s War (La Guerra de Hart) y The Great Raid, que se rodó en Australia. Fue uno de varios actores candidatos para hacer el papel de James Bond (que Pierce Brosnan había dejado) para la película de 2006 Casino Royale. El director, Martin Campbell declaró que sólo Worthington y Henry Cavill resultaron finalistas y en reñida competición con el que fue el ganador al final, Daniel Craig.\nEn 2007, James Cameron eligió a Worthington para el papel principal para la película Avatar. El 12 de febrero de 2008 saltó la noticia de que había sido elegido, por recomendación de Cameron, para el papel de Marcus Wright en Terminator Salvation, película ya estrenada en el mundo entero. En el 2010 puso la voz de Alex Mason, personaje principal del videojuego Call of duty: Black Ops.\nActualmente el artista se encuentra en Tenerife, Canarias (España), para la grabación de la segunda entrega de Furia de Titanes. Además, grabó un tráiler de Call of Duty: Modern Warfare 3 con Jonah Hill y Dwight Howard.\n', 'Sam_Worthington.jpg'),
(8, 'Zoe Saldana', 'EEUU', '1978-06-19', 'Zoe Saldana (Passaic, New Jersey el 19 de junio de 1978). Su padre, Aridio Saldaña, es dominicano y su madre Asalia Nazario puertorriqueña.', 'Zoe Saldana (Passaic, New Jersey el 19 de junio de 1978). Su padre, Aridio Saldaña, es dominicano y su madre Asalia Nazario puertorriqueña.\nSaldana todavía era miembro del grupo teatral Faces cuando consiguió espacio en un episodio de Law & Order (titulado ''Merger'') que se emitió por primera vez en 1999. Dejó la escuela después de su participación en la película Center Stage, apareciendo posteriormente junto a Britney Spears en Crossroads y en la comedia-dramática Drumline (2002). Desempeñó el papel de la pirata Anamaría en la película de 2003 Piratas del Caribe: La Maldición de la Perla Negra, y ha aparecido en películas como The Terminal junto a Tom Hanks (2004) y Guess Who (2005), con Ashton Kutcher. Ese mismo año protagonizó la película dominicana La maldición del padre Cardona junto a personalidades dominicanas como Freddy Beras Goico, Anthony Álvarez y Sergio Carlo.\nSaldana también fue la protagonista en el video para la canción de Juan Luis Guerra ''La Llave De Mi Corazón'', e interpretó a Uhura en la secuela de 2009 de la saga Star Trek. Además ese año interpretó a Neytiri, la princesa Na''vi, de la película Avatar de James Cameron, un papel que le dio mucha publicidad y reconocimiento, y por lo tanto oportunidades para trabajar en grandes producciones comerciales.\nZoe es la única actriz, que ha estado en tres películas consideradas entre las más taquilleras, en tres semanas consecutivas. Estas películas son Avatar, The Losers, y Death at a Funeral.\nEn agosto de 2010, se estrenó un anuncio de televisión de Saldaña para la marca Calvin Klein haciendo el debut de un producto llamado ''Envy''. En 2011, protagonizó el crimen-dramático Colombiana.\n', 'Zoe_Saldana.jpg'),
(9, 'Sigourney Weaver', 'EEUU', '1949-10-08', 'Sigourney Weaver (8 de octubre de 1949, Nueva York, Estados Unidos) es una actriz y productora estadounidense de cine, televisión y teatro.', 'Sigourney Weaver (8 de octubre de 1949, Nueva York, Estados Unidos) es una actriz y productora estadounidense de cine, televisión y teatro.\nCandidata a los Premios Óscar y a los Premios del Sindicato de Actores. Ganadora de dos Globo de Oro en las categorías de mejor actriz en drama y mejor actriz de reparto. Asimismo también ganadora de un BAFTA a la mejor actriz de reparto. Conocida por sus intervenciones como la Teniente Ripley en Alien (1979), Aliens (1986), Alien 3 (1992) y Alien Resurrection (1997). Ha participado en películas como Ghostbusters (1984), Gorilas en la niebla (1988), Working Girl (1988), The Village (2004) y Avatar (2009). También conocida como la ''reina de la ciencia-ficción''.\n', 'Sigourney_Weaver.jpg'),
(10, 'Ben Affleck', 'EEUU', '1972-08-15', 'Benjamin Geza ''Ben'' Affleck (Berkeley, California; 15 de agosto de 1972) es un actor, productor, guionista y director estadounidense.', 'Benjamin Geza ''Ben'' Affleck (Berkeley, California; 15 de agosto de 1972) es un actor, productor, guionista y director estadounidense. \nSe dio a conocer con sus actuaciones en las películas de Kevin Smith tales como Persiguiendo a Amy (1997) y Dogma (1999). Affleck ganó un Óscar y un Globo de Oro por el guion de Good Will Hunting (1997), que él co-escribió con Matt Damon, y ha aparecido en papeles principales en éxitos populares como Armageddon (1998), Pearl Harbor (2001), Changing Lanes (2002), The Sum of All Fears (2002), Daredevil (2003), o films de temática más seria como Hollywoodland (2007), La sombra del poder (2009) y The Town (2010). Affleck es un director de cine aclamado por la crítica. Dirigió Gone Baby Gone (2007),The Town (2010) y Argo (2012) desempeñando el papel principal en los dos últimos. La dirección y participación en Argo le valió un Óscar por Mejor Película, 2 Globos de Oro, 2 Premios BAFTA y el premio de Mejor Director del Sindicato de Directores entre otros galardones.\n', 'Ben_Affleck.jpg'),
(11, 'Bryan Cranston', 'EEUU', '1956-03-07', 'Bryan Cranston (nacido el 7 de marzo de 1956 en Valle de San Fernando, California) es un actor, escritor y director estadounidense.', 'Bryan Cranston (nacido el 7 de marzo de 1956 en Valle de San Fernando, California) es un actor, escritor y director estadounidense.\nSu personaje más popular lo interpretó en la serie Malcolm in the middle, interpretando a Hall Wilkerson, (padre de Malcolm) en el año 2000 y sucesivos.\nAntes de su papel en Malcolm, interpretó al astronauta Buzz Aldrin en la serie de HBO From the Earth to the Moon (HBO). También interpretó el papel del astronauta Gus Grissom en la película That Thing You Do!. También realizó un papel secundario en la serie Seinfeld, como el doctor Tim Whatley, el dentista de Jerry. Varios episodios están basados en la relación de Jerry con su dentista y su paranoia hacia los dentistas. Adicionalmente, ha tenido un papel en la comedia The King of Queens como Tim Sasky, un vecino molesto de Doug Heffernan; y en la serie Como conocí a vuestra madre como Hammond Druthers, un compañero de trabajo también molesto de Ted Mosby . Actualmente encarna al protagonista de la serie Breaking Bad, donde interpreta a un profesor de química que se introduce en el mundo del narcotráfico.\nEn la película de Steven Spielberg Saving Private Ryan interpreta el papel de oficial en el Departamento de Guerra al inicio de la película y en la película Little Miss Sunshine interpreta al agente literario de Greg Kinnear.\nCranston ha dirigido episodios de algunas de las diversas series en las que ha participado y ha recibido tres Premios Emmy por su papel de Walter White en la aclamada serie Breaking Bad . Además escribió y dirigió la película Last Chance, estrenada en 1999.\nEn el año 2011 vuelve al cine con la película ''El Inocente'' con el papel del detective Lankford y en ''El vengador del futuro''.\nEn 2012 interpreta a Jack O''Donnell en la película Argo considerada como una de las mejores películas del 2012, ganadora del Oscar a la mejor película de dicho año.\n', 'Bryan_Cranston.jpg'),
(12, 'Martin Freeman', 'Reino Unido', '1971-09-08', 'Martin John C. Freeman (8 de septiembre de 1971) es un actor británico.', 'Martin John C. Freeman (n. Aldershot, Hampshire; 8 de septiembre de 1971) es un actor británico conocido por su papeles en la película Guía del autoestopista galáctico (2004) y las series The Office (2001-2003) y Sherlock (2010-¿?). El 14 de diciembre de 2012 estrenó El hobbit: un viaje inesperado, película en la cual interpreta al famoso Hobbit Bilbo Bolsón, en 2013 y 2014 estrenará sus secuelas. Siendo el menor de los cinco hijos de una ama de casa con vocación de actriz llamada Philomena y un oficial de la Marina llamado Geoffrey, Martin Freeman se fue a vivir con su padre cuando el matrimonio se separó. Poco tiempo después su padre murió de un infarto y Martin se trasladó con su madre y su padrastro a Teddington. Allí estudió en una escuela secundaria católica y entre los nueve y los catorce años formó parte del equipo nacional británico de squash, a pesar\nde su estado enfermizo (padecía asma y era propenso a los desmayos). Tras dejar este deporte, se unió a un grupo de teatro local y asistió a la Central School of Speech and Drama. El público conoce a Freeman principalmente por interpretar el personaje central de Arthur Dent en Guía del autoestopista galáctico (The Hitchhiker''s Guide to the Galaxy, 2005), y como Tim en la exitosa serie cómica de la BBC, The Office (2001-2003). Para televisión, también ha participado en la miniserie Charles II: The Power and The Passion (2003) y en las series The Robinsons (2005), para la BBC, Hardware (2003-2004), para la ITV, y Sherlock (2010-presente), para la BBC. Entre los títulos cinematográficos en su haber, cabe citar Ali G anda suelto (Ali G Indahouse, 2002); Love Actually (2003); Confetti (2006); Arma fatal (Hot Fuzz, 2007), dirigida por Edgar Wright, responsable de\nZombies Party (Shaun of the Dead, 2004); Breaking and Entering (2006), de Anthony Minghella; The Good Night (2007); y de la mano de Peter Jackson las tres películas basadas en la novela El hobbit, donde interpreta a Bilbo Bolsón, y cuyo estreno se realizó a', 'Martin_Freeman.jpg'),
(13, 'Ian McKellen', 'Reino Unido', '1939-05-25', 'Sir Ian Murray McKellen, CH, CBE (n. Burnley, Lancashire; 25 de mayo de 1939), es un actor británico de teatro y cine, nominado al Óscar en ', 'Aunque nació en Burnley, McKellen pasó la mayor parte de su infancia en la localidad de Wigan, acudiendo más tarde a la Bolton School. Sus cuatro primeros años de vida transcurrieron bajo la amenaza de los bombardeos nazis de la Segunda Guerra Mundial, que según sus propias declaraciones, tuvieron un fuerte impacto psicológico en él. Estudió en la Bolton School, en el área metropolitana de Mánchester, y más tarde terminó sus estudios de interpretación en la Universidad de Cambridge. La familia McKellen profesaba una fuertemente arraigada fe cristiana, aunque no excesivamente puritana. Su madre (Margery Lois) falleció teniendo él 12 años y su padre (Denis Murray) se volvió a casar. Éste falleció cuando Ian contaba con 24 años, tras lo cual siguió manteniendo una buena relación con su madrastra, a la que confesó su homosexualidad. Según las palabras de McKellen, la viuda\nde su padre se mostró más contenta que disgustada, ya que sabía que Ian había dejado de mentir sobre su orientación sexual. Comenzó una relación con su primer compañero sentimental, Brian Taylor, en 1964, con quien vivió en Londres hasta 1972, cuando la relación terminó. En 1978 conoció al hombre con el que tendría su segunda relación seria en el Festival de Edimburgo. Su nombre era Sean Mathias, también actor, y tuvieron una relación algo agitada. Sus discusiones parecían tener muchas veces su raíz en la, por alguna razón, menos aclamada carrera de Mathias, que achacaba su poco éxito a su relación con Ian McKellen; aun así, también reconocía que él había intentado ayudarle siempre. Esta relación duró 10 años. McKellen ha trabajado en el cine durante toda su carrera como actor desde 1966. Sin embargo, fue en los años 1990 cuando sus apariciones comenzaron a ser más\nreseñables y significativas, con participaciones en proyectos que consiguieron éxito mundial, incluyendo películas como Sacerdote del amor (Christopher Miles, 1981), Walter (Stephen Frears, 1982), The Keep (Michael Mann, 1983), Plenty (Fred', 'Ian_McKellen.jpg'),
(14, 'Suraj Sharma', 'India', '1993-03-21', 'Suraj Sharma (n. Nueva Delhi, 21 de marzo de 1993), es un actor indio que se dio a conocer en 2012 por su protagonismo en la película estado', 'Suraj Sharma (n. Nueva Delhi, 21 de marzo de 1993), es un actor indio que se dio a conocer en 2012 por su protagonismo en la película estadounidense La Vida de Pi, dirigida por el director Ang Lee. Este filme se basó en la novela La vida de Pi de Yann Martel. Suraj nació en el seno de una familia keralite (malayali). Estudió en la escuela Sardar Patel Vidyalaya de Nueva Delhi. Su padre es ingeniero y su madre economista, ambos oriundos de Kerala (de Thalassery y Palakkad, respectivamente). Antes de la película, no tenía ninguna relación con el mundo cinematográfico ni tampoco había estudiado ninguna carrera artística. Sin embargo, Ang Lee lo escogió para el papel de actor principal entre otros 3000 candidatos por su apariencia inocente, su mirada profunda y su complexión física tan semejante a la de Pi. Suraj ha declarado que se presentó al casting porque su hermano menor\nlo animó a ello. Suraj ha recibido el Premio Joven de la sociedad de críticos de Las Vegas. Además, ha sido nominado a un BAFTA, un NAACP Image Awards7 y un Critic''s Choice Awards.8 Tras la película, Suraj ha retomado sus estudios en la carrera de filosofía de la Universidad de Delhi y pretende seguir con su futuro cinematográfico.\n', 'Suraj_Sharma.jpg'),
(15, 'Daniel Craig', 'Reino Unido', '1968-03-02', 'Daniel Wroughton Craig (n. 2 de marzo de 1968) es un actor británico conocido especialmente por interpretar en el cine al personaje de Ian F', 'Daniel Wroughton Craig (n. 2 de marzo de 1968) es un actor británico conocido especialmente por interpretar en el cine al personaje de Ian Fleming James Bond. A finales de 2012, es el sexto y último actor en interpretar el papel de James Bond en las adaptaciones oficiales de las películas producidas por EON Productions como Casino Royale, Quantum of Solace (2008) y Skyfall (2012). El actor, forjado en la compañía británica Teatro Nacional de la Juventud (National Youth Theatre), se graduó en la Escuela Guildhall de Música y Drama de Londres donde comenzó su carrera en el escenario. Debutó en el cine con La fuerza de Uno (1992), a la cual siguieron otras interpretaciones en películas como Elizabeth y Las Aventuras en la corte del Rey Arturo, en televisión participó en El Zorro y El águila de Sharpe. Actuaciones en el cine británico como las de Love is the Devil, La\ntrinchera o Algunas voces atrajeron la atención de la industria sobre él haciéndole llegar papeles de más calado internacional como la versión cinematográfica del videojuego Lara Croft: Tomb Raider (2001), Layer Cake (2004), o las nominadas al Óscar Camino a la perdición (2002) de Sam Mendes y Munich (2005) de Steven Spielberg. Craig alcanzó la fama internacional cuando fue elegido como el sexto actor para interpretar el papel de James Bond, en sustitución de Pierce Brosnan. Aunque inicialmente recibido con escepticismo, su debut en Casino Royale fue muy aclamado por la crítica y le valió una nominación al premio BAFTA, consiguiendo además que Casino Royale fuera la película más taquillera de la franquicia hasta esa época. En 2006 pasó a formar parte de la Academia de Artes y Ciencias Cinematográficas. Daniel Craig está casado en segundas nupcias con Rachel Weisz\ny tiene una hija de su anterior matrimonio. En la lista Top 40 celebridades de Hollywood con más ingresos a lo largo de 2010 que publicó Vanity Fair, Craig ocupaba la posición 28 con unas ganancias estimadas en unos 18 millones de dólares por sus ', 'Daniel_Craig.jpg'),
(16, 'Javier Bardem', 'España', '1969-03-01', 'Javier Ángel Encinas Bardem (Las Palmas de Gran Canaria, Gran Canaria, España, 1 de marzo de 1969), más conocido como Javier Bardem, es el p', 'Javier Ángel Encinas Bardem (Las Palmas de Gran Canaria, Gran Canaria, España, 1 de marzo de 1969), más conocido como Javier Bardem, es el primer actor español que estuvo nominado a un premio Óscar y el primero en ganarlo ocho años más tarde por su papel en No Country for Old Men (2008). Además, ha ganado seis Goyas, un Globo de Oro, un BAFTA, el premio del Festival de Cannes al mejor actor y un premio del Sindicato de Actores. Está casado con la actriz Penélope Cruz, con la que ha trabajado en Jamón, jamón, Carne trémula y Vicky Cristina Barcelona. El primer hijo del matrimonio, llamado Leo, nació el 22 de enero de 2011 en Los Ángeles. Nacido en el barrio de San Nicolás en Las Palmas de Gran Canaria, hijo de José Carlos Encinas Doussinague de origen cubano español y Pilar Bardem, Bardem desciende de una saga de actores: sus abuelos Rafael Bardem y Matilde Muñoz\nSampedro, su madre Pilar y su hermano mayor Carlos son un ejemplo. Pero también su tío Juan Antonio Bardem y su primo Miguel han destacado como directores de cine. Aun así, Javier empezó en las categorías inferiores de la selección española de Rugby y llegó a jugar hasta 1990 con el CR Liceo Francés de Madrid en las posiciones de pilier y tercera línea hasta la categoría senior antes de estudiar Pintura en la Escuela de Artes y Oficios y continuar con su formación en Juan Carlos Corazza, estudio con el que sigue vinculado a día de hoy. Con solo cuatro años, Bardem hizo un papel pequeño en la serie de televisión El pícaro (1974), aunque no aparece en los créditos. Su primera escena como actor estuvo marcada por una anécdota con Fernando Fernán Gómez. Según explica el artista, en la secuencia Fernán Gómez le apuntaba con una pistola y él tenía que reirse. En cambio,\nse asustó y lloró. Su compañero de trabajo le quitó peso a la situación y exclamó: ''No pasa nada, dejadle, es un actor dramático''. Con 11 años, Bardem tuvo un pequeño papel en la película protagonizada por su madre El poderoso influjo de la Luna, d', 'Javier_Bardem.jpg'),
(17, 'Naomi Watts', 'Reino Unido', '1968-09-28', 'Naomi Watts (28 de Septiembre de 1968; Shoreham Kent, Reino Unido) es una actriz nacida en Reino Unido pero de nacionalidad australiana. Wat', 'Naomi Watts (28 de Septiembre de 1968; Shoreham Kent, Reino Unido) es una actriz nacida en Reino Unido pero de nacionalidad australiana. Watts comenzó su carrera en la televisión australiana, donde apareció en anuncios y series, incluyendo la telenovela Home and Away, la galardonada miniserie Novias de Cristo y en la comedia ¡Oye, papá ...! En el cine Watts es conocida por sus papeles en las películas Mulholland Drive (2001), donde se dio a conocer al gran público, The Ring (2002), 21 gramos (2003), que fue nominada a dos Premios de la Academia, King Kong (2005), donde actuó junto con Jack Black y Adrien Brody, y más recientemente en The International (2009). Ha trabajado con directores de la talla de David Lynch, Peter Jackson, Woody Allen, Clint Eastwood o el español Juan Antonio Bayona. En el 2013 fue nominada por segunda vez al Oscar a la mejor actriz por su papel en Lo imposible.\nWatts nació en Shoreham, Kent en Inglaterra, donde vivió hasta los ocho años. Sus padres, Gilette Edwards Braun (una galesa vendedora de antigüedades y diseñadora de ropa) y Peter Watts (un inglés chapero de giras e ingeniero de sonido del grupo Pink Floyd, quién aparece en la caratula trasera del álbum ''Ummagumma'' con camisa blanca), se separaron cuando ella tenía cuatro años.\nPoco después, su madre se trasladó con el resto de la familia a la localidad de Llangefni (concretamente a uno de sus distritos llamado Llanfawr), al noroeste de Gales, donde vivirían con sus abuelos Hugh y Nikki Roberts. Aunque su madre se trasladaba algunas veces a Gales e Inglaterra, normalmente por sus noviazgos, siempre terminaba volviendo a Llangefni. Al cumplir los catorce años y durante un viaje a Australia, su madre se dio cuenta de que era ''la tierra de las oportunidades'' y se trasladaron a Sídney en 1982. Su abuela, Nikki, era australiana, así que no fue difícil obtener la documentación necesaria; desde entonces Naomi y su familia son ciudadanos australianos. Naomi describe a su madre como una hippie ', 'Naomi_Watts.jpg'),
(18, 'Ewan McGregor', 'Escocia', '1971-03-31', 'Ewan Gordon McGregor (nacido el 31 de marzo de 1971 en Crieff, Escocia) es un actor de cine y televisión británico más conocido por interpre', 'Ewan Gordon McGregor (nacido el 31 de marzo de 1971 en Crieff, Escocia) es un actor de cine y televisión británico más conocido por interpretar al Caballero Jedi Obi-Wan Kenobi en los tres primeros episodios de la saga de George Lucas, Star Wars. McGregor también ha actuado como la contraparte masculina en películas románticas de Hollywood como Moulin Rouge! y Abajo el amor ambas con gran aceptacion del publico, aunque su interpretación más venerada y la que lo lanzó a la fama fue la de Mark Renton, el protagonista antihéroe de la película de culto Trainspotting de Danny Boyle. En 2005 interpretó a un psiquiatra en la película Stay de Marc Foster y en 2006 personificó a Ian Rider en la adaptación de la serie de libros de Alex Rider, la película se tituló Stormbreaker y fue dirigida por Geoffrey Sax. Ha participado en la superproducción Ángeles y demonios, junto\na Tom Hanks. También es cantante. McGregor está casado con Eve Mavrakis, una diseñadora francesa, desde 1995 con quien tiene tres hijas biológicas: Clara Mathilde, nacida en febrero de 1996, Esther Rose, nacida el 7 de noviembre de 2001, y Anouk, nacida en enero de 2011 y adoptó otra hija, Jamiyan en 2006.\nEwan McGregor nació en Crieff, Escocia en 1971. Asistió desde 1988 a la Guildhall School of Music and Drama para estudiar arte dramático. Seis meses antes de graduarse, consiguió un papel protagonista en la serie de 6 capítulos Lipstick on your Collar de Dennis Potter, en la BBC. Desde entonces ha trabajado continuamente. Su debut en el cine fue en 1993 con el film Being Human junto a Robin Williams. Su trabajo recibiría buenas críticas y ganó al año siguiente el premio Empire Award por su actuación en el thriller Shallow Grave, en el cual trabajó por primera vez con el director Danny Boyle. Este último le dirigiría también en la película Trainspotting de 1996, dándole prestigio internacional al actor, quien interpretó a Mark Renton, un adicto a la heroína en esta historia, desarrollada en Edimburgo y Londr', 'Ewan_McGregor.jpg'),
(19, 'Jeremy Renner', 'EEUU', '1971-01-07', 'Jeremy Lee Renner (nacido el 7 de enero del 1971 en Modesto) es un actor estadounidense.', 'Jeremy Lee Renner (nacido el 7 de enero del 1971 en Modesto) es un actor estadounidense. Renner nació en Modesto, California, siendo el mayor de seis hermanos; Brianna Renner, Nicky Emens, Kim Renner, Clayton Renner y Theo Renner . Sus padres son Lee Renner y Valerie Cearley,y actualmente vive en Los Angeles,CA. Antes de interesarse por el cine, sus pasiones se centraban en la criminología y la computación, pero el teatro pudo más y se trasladó a San Francisco, donde estuvo en producciones locales. Al tiempo se iría a vivir a Los Angeles, donde su vida transcurría entre múltiples audiciones y actuaciones en pequeños teatros.\nRespecto a las relaciones amorosas que ha mantenido se sabe muy poco, Jeremy, al interpretar diversos personajes de carácter insano se ha ganado su consideración de antigalán. Tras ser nominado al Oscar y ascender a categoría de estrella se le ha relacionado con Jessica Simpson y Christina Aguilera. Es un gran amigo de Charlize Theron , Colin Farrell,Scarlett Johansson y Eva Longoria.\nJeremy comenzó su carrera cinematográfica acudiendo a diversos castings para series televisivas y películas producidas directamente para la televisión. Salvo en su debut en la comedia Desmadre sobre ruedas (1995), Jeremy se concentró en realizar papeles dramáticos para cintas de thriller o drama.\nA finales de los 90s y principios del 2000, Renner apareció en comerciales de Pizza Hut, Duracell y Bud Light. Fue mas ambicioso en sus castings y probó suerte para interpretar papeles secundarios en series televisivas de gran éxito como C.S.I., Ángel o El tiempo de tu vida.\nA pesar de protagonizar el drama Fish in a Barrel y la comedia romántica Monkey Love, la película por la que se dió a conocer y por la que obtuvo numerosas alabanzas y nominaciones fue Dahmer(2002), en la que interpreta al conocido psicópata caníbal Jeffrey Dahmer. Este papel le premitió atender a diversos proyectos y elegir determinados papeles. Así, rechazó aparecer en la película Golpe en Hawai para', 'Jeremy_Renner.jpg'),
(20, 'Rachel Weisz', 'Reino Unido', '1970-03-07', 'Rachel Hannah Weisz (n. Londres, Inglaterra, 7 de marzo de 1970) es una actriz y modelo británica, ganadora del Óscar, el Globo de Oro, el S', 'Rachel Hannah Weisz (n. Londres, Inglaterra, 7 de marzo de 1970) es una actriz y modelo británica, ganadora del Óscar, el Globo de Oro, el SAG, el Premio Laurence Olivier, el Independent Spirit Awards y otros premios cinematográficos. Ganó reconocimiento público por su interpretación de Evelyn Evy Carnahan-O''Connell en la serie cinematográfica La momia. En 2001, protagonizó junto a Hugh Grant la película About a Boy, y su actuación en El jardinero fiel (2005) le mereció el Premio Óscar de la Academia.\nWeisz nació en Westminster, Inglaterra, y creció en el suburbio de Hampstead Garden. Su madre, Edith Ruth (de soltera Teich), es profesora y luego psicoterapeuta nacida en Viena, Austria. Su padre, George Weisz, es un inventor e ingeniero húngaro. Los padres de Weisz se trasladaron a Inglaterra durante la Segunda Guerra Mundial. El padre de Weisz es judío y su madre se ha catalogado como católica, o judía. Weisz creció en un ''hogar cerebralmente judío'' y se refiere a si misma como judía. Weisz tiene una hermana, Minnie Weisz, quien es artista.\nWeisz se educó en el North London Collegiate School. Más tarde ingresó a Benenden School y después se matriculó en St Paul''s Girls'' School. Ingresó a Trinity Hall de la Universidad de Cambridge, donde se graduó de literatura inglesa con una calificación 2:1. Durante sus años universitarios apareció en varias producciones estudiantiles, siendo cofundadora el grupo teatral estudiantil Cambridge Talking Tongues, la cual ganó el Guardian Student Drama Award en el Festival de Edimburgo gracias a una improvisación llamada Slight Possession.\nDespués de trabajar inicialmente en la televisión, Weisz comenzó su carrera fílmica en 1996 en el filme de Bernardo Bertolucci, Belleza robada. En 2001 regresaría al teatro, en el papel de Evelyn en The Shape of Things.\nSe hizo conocida por los filmes La Momia, su secuela El regreso de la momia y Enemigo a las puertas, en los que realizó notables interpretaciones. Su papel en Constantine fue uno de ', 'Rachel_Weisz.jpg'),
(21, 'Thomas Mann', 'EEUU', '1991-09-27', 'Thomas Mann (nacido el 27 de septiembre 1991) es un actor estadounidense. Él es mejor conocido por su papel de Thomas Kub en Projecto X.', 'Thomas Mann (nacido el 27 de septiembre 1991) es un actor estadounidense. Él es mejor conocido por su papel de Thomas Kub en Projecto X.\nMann nació en Portland, Oregon. Ha vivido en Dallas, Texas, desde que tenía 2 años de edad.\nEn 2009, Mann hizo su debut como actor en la sitcom de Nickelodeon iCarly. En octubre de 2010, Mann hizo su debut en el cine junto a Emma Roberts y Zach Galifianakis en la película de comedia-drama que es una especie de historia divertida. Ese mismo año, Mann fue elegido como el protagonista de la comedia negra Proyecto X. A Mann se le dijo que no podía audicionar para la película ya que los productores sólo deseaban gente sin créditos actorales; Mann recibió finalmente el papel después de audicionar siete veces. La película se centra en Thomas Kub, que realiza una fiesta por su cumpleaños que, casi desde el principio de la celebración, se le va de las manos. La filmación comenzó en junio de ese mismo año en Los Angeles, California, con un presupuesto de $ 12 millones. La película recibió críticas negativas de los críticos, pero fue un éxito de taquilla y recaudó más de\n$ 100 millones a nivel mundial. Una secuela planeada se cree que esta en fase de desarrollo y no se sabe si Mann volverá. En abril de 2011, Mann fue confirmado para protagonizar el Fun Size de Paramount Pictures; Es una comedia adolescente, que es protagonizada por Victoria Justice. La película se centra en el personaje de Justice, cuyo hermano se pierde cuando va a una fiesta. Las inclemencias retrasaron el rodaje hasta inicios del 2012. The OC marco la película como el debut cinematográfico direccional del creador de Gossip Girl, Josh Schwartz y fue lanzada en octubre de 2012. En marzo de 2012, la revista de entretenimiento Variety dijo que Mann protagonizará la adaptación cinematográfica de la novela de 2006, King Dork. Seth Gordon se establece para dirigir la película.\n', 'Thomas_Mann.jpg'),
(22, 'Oliver Cooper', 'EEUU', '1990-04-20', 'El actor Oliver Cooper nació en Sylvania, un suburbio de la ciudad de Toledo, Ohio, en los Estados Unidos.', 'El actor Oliver Cooper nació en Sylvania, un suburbio de la ciudad de Toledo, Ohio, en los Estados Unidos. Cooper se graduó en la Sylvania Northview High School en el año 2008; durante esa época ya interpretaba monólogos en clubes locales. Tras estudiar un año en la Arizona State University, decidió mudarse a la ciudad de Los Ángeles cuando contaba con sólo 19 años de edad. En su, hasta el momento corta carrera, Oliver debutó frente a cámaras, en el cortometraje ''Weekend Dad'', en el año 2010. Un año más tarde, protagonizó, y también produjo el corto ''Rick White'', dirigido por su amigo de Sylvania, Joe Burke. Burke también fue el director del corto ''Marriage Drama with Virginia Madsen'' (2011), basado en una historia que escribió Cooper y que también protagonizó junto a la actriz Virginia Madsen.\nEn 2012 se estrenó ''Proyecto X'' que marcó su debut en un largometraje; en él, Cooper coprotagoniza con Thomas Mann y Jonathan Daniel Brown una típica historia de estudiantes secundarios que, tratando de ser populares, organizan una fiesta que se sale de control. La película, que contó con un presupuesto de 21 millones de dólares, recaudó más del doble en las dos primeras semanas de estreno, lanzando la carrera de Oliver quien se encuentra actualmente involucrado en varios otros proyectos cinematográficos.\n', 'Oliver_Cooper.jpg'),
(23, 'Johnny Depp', 'EEUU', '1963-06-09', 'John Christopher Depp II (Owensboro, Kentucky; 9 de junio de 1963), conocido artísticamente como Johnny Depp, es un actor y productor estado', 'John Christopher Depp II (Owensboro, Kentucky; 9 de junio de 1963), conocido artísticamente como Johnny Depp, es un actor y productor estadounidense nominado en tres oportunidades al Óscar y ganador de un Globo de Oro, un Premio del Sindicato de Actores y de un Premio César.\nJohnny Depp nació en Owensboro, Kentucky, hijo de la camarera Betty Sue Palmer -cuyo apellido de soltera era Wells- y John Christopher Depp, Sr., un ingeniero civil. Tiene un hermano, Daniel (que es escritor), y dos hermanas: Christie, que trabaja como su administradora personal, y Debbie. Cabe señalar que Depp tiene ascendencias francesa, alemana, cheroqui e irlandesa, por lo que el propio Depp se autocalifica en entrevistas como un perro mestizo. Según algunos biógrafos, la familia estadounidense Depp surgió cuando un inmigrante francés hugonote, Pierre Deppe o Dieppe, se estableció en Virginia aproximadamente en 1700, y se integró en una colonia de refugiados ubicada sobre la cascada del río James.\nDepp se mudó varias veces en su infancia: más de veinte lugares de mudanza acabaron en Miramar (Florida) cuando el actor tenía tan solo siete años. En 1978, con 15 años de edad, sus padres se divorciaron y tuvo una etapa bohemia, durante la cual se sumió en las drogas. Depp, que dice estar limpio, considera esta etapa como superada.\nJohnny Depp se hizo copropietario del famoso bar The Viper Room, y dejó de serlo en 2004, conocido por la muerte de la celebridad River Phoenix, quien murió frente a éste en 1993 y por lo cual Johnny Depp cerraba el bar cada 31 de octubre en honor al actor. Los críticos atacaron diciendo que ese lugar era la ''cuna de la marihuana de Los Ángeles''. Perturbado por la muerte y por cómo los paparazzi jugaban con el tema, Depp terminó cerrándolo durante una semana.\nUna de las peores etapas por las que pasó fue como dice: la etapa oscura de mi vida: durante su separación con Ryder, Johnny asistía a ciertas fiestas liberales como una forma de olvidarse por todo el dolor que hab', 'Johnny_Depp.jpg'),
(24, 'Michelle Pfeiffer', 'EEUU', '1958-04-29', 'Michelle Marie Pfeiffer (Santa Ana, California; 29 de abril de 1958) es una actriz estadounidense.', 'Michelle Marie Pfeiffer (Santa Ana, California; 29 de abril de 1958) es una actriz estadounidense. Además de su trabajo actoral, por el que ha sido nominada en tres ocasiones a los premios Óscar y en seis a los premios Globo de Oro, su significativa presencia mediática se debe también a su consideración como una de las mujeres más atractivas del mundo. Pfeiffer comenzó su carrera actoral al aparecer como invitada en programas de televisión, entre los que se incluyen papeles pequeños en las series La isla de la fantasía y Delta House, a finales de los años 1970. Debutó en el cine en 1980 en el largometraje The Hollywood Knights. Posteriormente, obtuvo reconocimiento de la prensa y los críticos con la interpretación de papeles en películas como Las Amistades Peligrosas (1988), Casada con todos (1988), Los fabulosos Baker Boys (1989), La casa Rusia (1990), Frankie & Johnny (1991), Por encima de todo (1992),\nBatman vuelve (1992) y La edad de la inocencia (1993). Sus interpretaciones la hicieron acreedora de numerosos premios y galardones, entre ellos un premio BAFTA, un Globo de Oro y un Oso de Plata.\nMichelle nació en Santa Ana (condado de Orange, California) y tiene tres hermanos, Richard, mayor que Michelle, Dedee (actriz) y Lori (Modelo) menores que ella. Es de ascendencia neerlandesa, alemana, irlandesa, sueca y suiza. Su primer salario lo ganó sacando brillo a las máquinas de aire acondicionado que su padre arreglaba. En la escuela siempre se comportó como un chico, según propias palabras de la actriz, y no llamaba la atención de los muchachos. Años más tarde, fue la típica chica rubia que se saltaba las clases para pasar las tardes con sus amigos surfistas, tomando batidos y alguna que otra droga en la playa. En 1981 se casó con el también actor Peter Horton, del que se divorció en 1988. Después tuvo idilios con Michael Keaton, John Malkovich y Fisher Stevens, con el que planeó una boda, pero una infidelidad del actor dejó de nuevo a Michelle soltera. En 1993 ado', 'Michelle_Pfeiffer.jpg'),
(25, 'Jason Biggs', 'EEUU', '1978-05-12', 'Jason Matthew Biggs (Hasbrouck Heights, Nueva Jersey, Estados Unidos 12 de mayo de 1978) es un actor ítalo-estadounidense que alcanzó la fam', 'Jason Matthew Biggs (Hasbrouck Heights, Nueva Jersey, Estados Unidos 12 de mayo de 1978) es un actor ítalo-estadounidense que alcanzó la fama con su papel de Jim Levenstein en la saga cómica American Pie.\nBiggs nació en Pompton Plains, Nueva Jersey, hijo de Angela, una enfermera, y Gary Biggs, un gerente de una compañía de envío. Creció en Hasbrouck Heights, Nueva Jersey, y asistió al Hasbrouck Heights High School. Biggs tuvo éxito en los deportes mientras estaba en la secundaria, en tenis y lucha libre. Ganó un título estatal en su último año y avanzó a las rondas finales en un torneo nacional.\nBiggs es italo-americano y católico romano; él ha mencionado en entrevistas que es a menudo elegido como un personaje judío, como lo fue en American Pie (otros ejemplos incluyen en Saving Silverman y Anything Else), aunque no es judío.\nEn enero de 2008, se comprometió con la actriz Jenny Mollen; y se casaron el 23 de abril de 2008. Actualmente vive en Los Ángeles, California. Biggs comenzó a actuar a los cinco años. En 1992, hizo su debut en televisión en la serie Drexell''s Class. También hizo un especial de HBO, The Fotis Sevastakis Story, debido a los argumentos de concesión de licencias, nunca salió al aire. Ese mismo año, Biggs debutó en Broadway, en Conversations with My Father, que lo ayudó a participar en As the World Turns. Estuvo nominado por un premio al Mejor Actor Joven en una telenovela en los Premios Emmy por este papel.\nBiggs asistió a la Universidad de Nueva York desde 1996 a 1997, pero poco después, regresó a seguir su carrera de actuación. Actuó en otra serie, Camp Stories en 1997. Luego protagonizó en American Pie, que fue un éxito internacional y tuvo cuatro secuelas (con Biggs), siendo la última entrega en el 2012 y seis spin offs (que no son protagonizadas por Biggs). Biggs ha aceptado papeles en películas como Loser en 2000, y otras. En 2004 y 2005, Biggs interpretó a un judío ortodoxo en Modern Orthodox, en Nueva York. En 2006, fue visto en el realy s', 'Jason_Biggs.jpg');
INSERT INTO `actores` (`ID_ACTOR`, `NOMBRE_APE`, `NACIONALIDAD`, `FECHA_NAC`, `DESCRIPCION`, `CARRERA`, `IMAGEN`) VALUES
(26, 'Seann William Scott', 'EEUU', '1976-10-03', 'Sean William Scott (nació el 3 de octubre de 1976, Cottage Grove, Minnesota, Estados Unidos) es un modelo, actor y comediante conocido por s', 'Sean William Scott (nació el 3 de octubre de 1976, Cottage Grove, Minnesota, Estados Unidos) es un modelo, actor y comediante conocido por su papel de Steve Stifler en American Pie, una serie de comedias adolescentes. También es conocido por su papel en The Rundown, Destino Final, Road Trip, Evolución, Dude, Where''s My Car?, Los Dukes de Hazzard y Role Models.\nScott es el más joven de siete hermanos. Nació en Cottage Grove, Minnesota, hijo de Patricia Ann, un ama de casa y William Frank Scott, obrero. Mientras estaba en la Universidad de Wisconsin-Madison, el mayor de sus hermanos, Daniel, le ayudó a fundar The Onion, en donde fue uno de los primeros escritores. Decidió ser actor cuando trabajaba en una sala de cine local. Veía todas las películas que podía en su tiempo libre. Se graduó de la Escuela Primaria Crestview y Park High School. Después de su graduación, asistió a Glendale Community College. Su primera actuación profesional fue en televisión, en el vídeo musical de Hole in My Soul de Aerosmith. Poco después del vídeo, apareció en el programa Chad''s World, un programa de televisión de temática gay difundido en la web por la efímera Digital Entertainment Network.\nComenzó su carrera como actor en los teatros de Broadway, actuando en varias comedias musicales. El primer éxito comercial de Scott llegó en 1999 con la película American Pie como Steve Stifler, un papel que interpretó en tres secuelas American Pie 2, American Wedding y American Reunion Durante una entrevista para la BBC Radio 1 contó que sólo cobró 8.000 dólares por esa primera película. Aunque el personaje de Steve Stifler ha marcado un hito, el actor ha mencionado en diversas entrevistas que su temor a encasillarse le ha llevado a elegir interpretar diferentes tipos de personajes. Después de American Pie, hizo de estudiante en la película Destino final y un personaje inofensivo como Chester en Colega, ¿Dónde está mi coche? en España y Hey, ¿dónde está mi auto? en Hispanoamérica junto a su mejor a', 'Seann_William_Scott.jpg'),
(27, 'Alyson Hannigan', 'EEUU', '1974-03-24', 'Alyson Lee Hannigan-Denisof (24 de marzo de 1974, Washington D.C., Estados Unidos), más conocida como Alyson Hannigan, es una actriz conocid', 'Alyson Lee Hannigan-Denisof (24 de marzo de 1974, Washington D.C., Estados Unidos), más conocida como Alyson Hannigan, es una actriz conocida por sus papeles de Willow Rosenberg en Buffy, la cazavampiros, Michelle Flaherty en todas las películas de la saga American Pie, y Lily Aldrin en How I Met Your Mother.\nHannigan, unica hija de la corredora de bienes raíces Emilie Posner y el camionero Al Hannigan, es judía por parte de madre y también tiene ascendencia irlandesa.  Un año después de su nacimiento, sus padres se separaron y ella se crio principalmente en Atlanta junto a su madre. Asistió a la Escuela Preparatoria North Hollywood, donde audicionó con éxito para los agentes, mientras visitaba a su padre en Santa Bárbara. Estudió en la Universidad Estatal de California, Northridge.\nA pesar de haber aparecido en un film industrial para Active Parenting y en un anuncio para las galletas Duncan Hines (1978), no comenzó oficialmente su carrera hasta 1985. Debutó en el cine ese mismo año con Impure Thoughts. Su primer gran papel fue en la película cómica de ciencia ficción Mi novia es un extraterrestre (1988). Como curiosidad cabe decir que uno de sus compañeros fue Seth Green, que sería su novio en la ficción en Buffy, la cazavampiros.\nEn 1989 consiguió su primer papel regular en Free Spirit (ABC). A lo largo de los 90 apareció en varios anuncios de televisión. Durante esa década también protagonizó varios telefilmes como Cambiadas al nacer (1991) o A case for life (1996).\nEn 1997 consiguió el papel de Willow Rosenberg en Buffy, la cazavampiros, serie que se convirtió en un éxito y que le sirvió el reconocimiento del público. En su recta final en la serie (2003), la actriz cobraba 250.000 dólares por episodio. Gracias a su trabajo en esta serie, Hannigan apareció en American Pie, American Pie 2, American Wedding y Boys and Girls. Recuperó su papel de Willow en la séptima temporada de la serie y en la cuarta del spin-off de ésta: Angel.\nA principios de 2004 realizó su d', 'Alyson_Hannigan.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actua`
--

CREATE TABLE IF NOT EXISTS `actua` (
  `ID_ACTOR` int(11) NOT NULL,
  `ID_PELICULA` int(11) NOT NULL,
  PRIMARY KEY (`ID_ACTOR`,`ID_PELICULA`),
  KEY `FK_ACTUA_PELICULAS` (`ID_PELICULA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `actua`
--

INSERT INTO `actua` (`ID_ACTOR`, `ID_PELICULA`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2),
(5, 2),
(6, 2),
(7, 3),
(8, 3),
(9, 3),
(10, 4),
(11, 4),
(12, 5),
(13, 5),
(14, 6),
(15, 7),
(16, 7),
(17, 8),
(18, 8),
(19, 9),
(20, 9),
(21, 10),
(22, 10),
(23, 11),
(24, 11),
(25, 12),
(26, 12),
(27, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `ID_COMENTARIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USUARIO` int(11) NOT NULL,
  `ID_PELICULA` int(11) NOT NULL,
  `FECHA_COMENT` datetime NOT NULL,
  `COMENTARIO` varchar(140) NOT NULL,
  PRIMARY KEY (`ID_COMENTARIO`),
  UNIQUE KEY `UK_COMENTARIOS` (`FECHA_COMENT`),
  KEY `FK_COMENTARIOS_USUARIOS` (`ID_USUARIO`),
  KEY `FK_COMENTARIOS_PELICULAS` (`ID_PELICULA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`ID_COMENTARIO`, `ID_USUARIO`, `ID_PELICULA`, `FECHA_COMENT`, `COMENTARIO`) VALUES
(1, 2, 1, '2013-04-15 00:00:00', 'Comentario 1 de la pelicula batman'),
(2, 3, 1, '2013-04-04 00:00:00', 'Comentario 2 de la pelicula batman'),
(3, 3, 2, '2013-04-17 00:00:00', 'Comentario 1 de la película los mercenarios 2'),
(9, 5, 1, '2013-04-15 14:03:55', 'sd dfsf sd fsdf sd fsd fsd f '),
(10, 5, 1, '2013-04-15 14:04:26', 'comentario final'),
(11, 5, 3, '2013-04-15 15:41:23', 'comentario dm9 a avatar'),
(12, 5, 5, '2013-04-15 16:18:37', 'comentario para el hobbit');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE IF NOT EXISTS `datos` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOS` varchar(80) NOT NULL,
  `TELEFONO` varchar(15) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `CIUDAD` varchar(50) NOT NULL,
  `DIRECCION` varchar(80) NOT NULL,
  `COD_POSTAL` varchar(10) NOT NULL,
  `PAIS` varchar(50) NOT NULL,
  `FECHA_NAC` date NOT NULL,
  `SEXO` varchar(10) NOT NULL,
  `N_TARJETA` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  UNIQUE KEY `UK_DATOS` (`EMAIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`ID_USUARIO`, `NOMBRE`, `APELLIDOS`, `TELEFONO`, `EMAIL`, `CIUDAD`, `DIRECCION`, `COD_POSTAL`, `PAIS`, `FECHA_NAC`, `SEXO`, `N_TARJETA`) VALUES
(1, 'david', 'marina simon', '916636520', 'dms@fgf.com', 'madrid', 'sdfsdf', '28830', '0', '0000-00-00', 'hombre', NULL),
(2, 'david', 'sdfsdf', '916666666', 'sdsd@fgdg.com', 'madrid', 'sdfsdf', '28830', '0', '0000-00-00', 'hombre', NULL),
(4, 'fernando', 'perez', '916636520', 'dsfdfs@dsfsdf.com', 'madrid', 'sdfsdf', '28830', '0', '0000-00-00', 'hombre', NULL),
(5, 'vero', 'sdfsdf', '916636520', 'dfsdfdsf@sdfdsdf.com', 'madrid', 'sdfsdf', '28830', '0', '0000-00-00', 'mujer', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE IF NOT EXISTS `generos` (
  `ID_GENERO` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_GENERO` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_GENERO`),
  UNIQUE KEY `UK_GENEROS` (`NOM_GENERO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`ID_GENERO`, `NOM_GENERO`) VALUES
(1, 'Acción'),
(3, 'Aventuras'),
(9, 'Bélico'),
(4, 'Ciencia ficción'),
(11, 'Comedia'),
(6, 'Drama'),
(7, 'Fantastico'),
(10, 'Intriga'),
(8, 'Romance'),
(5, 'Terror'),
(2, 'Thriller');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gen_pel`
--

CREATE TABLE IF NOT EXISTS `gen_pel` (
  `ID_GENERO` int(11) NOT NULL,
  `ID_PELICULA` int(11) NOT NULL,
  PRIMARY KEY (`ID_GENERO`,`ID_PELICULA`),
  KEY `FK_GEN_PEL_PELICULAS` (`ID_PELICULA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gen_pel`
--

INSERT INTO `gen_pel` (`ID_GENERO`, `ID_PELICULA`) VALUES
(1, 1),
(2, 1),
(6, 1),
(1, 2),
(1, 3),
(3, 3),
(4, 3),
(7, 3),
(8, 3),
(9, 3),
(2, 4),
(6, 4),
(10, 4),
(1, 5),
(3, 5),
(7, 5),
(3, 6),
(6, 6),
(1, 7),
(2, 7),
(6, 8),
(1, 9),
(11, 10),
(5, 11),
(7, 11),
(11, 11),
(11, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `ID_NOTICIA` int(11) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(50) NOT NULL,
  `DESCRIPCION` varchar(140) NOT NULL,
  `TEXTO_NOTICIA` varchar(2000) NOT NULL,
  `IMAGEN` varchar(30) NOT NULL,
  `VIDEO` varchar(60) DEFAULT NULL,
  `FECHA` date NOT NULL,
  `ID_PELICULA` int(11) DEFAULT NULL,
  `ID_ACTOR` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_NOTICIA`),
  UNIQUE KEY `FK_NOTICIAS` (`TITULO`),
  KEY `FK_NOTICIAS_PELICULAS` (`ID_PELICULA`),
  KEY `FK_NOTICIAS_ACTORES` (`ID_ACTOR`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`ID_NOTICIA`, `TITULO`, `DESCRIPCION`, `TEXTO_NOTICIA`, `IMAGEN`, `VIDEO`, `FECHA`, `ID_PELICULA`, `ID_ACTOR`) VALUES
(1, 'Fallece Richard Griffiths, el tío Vernon de Harry ', 'El veterano actor ha fallecido a los 65 años por complicaciones tras una operación coronaria', 'En España le conocimos como el odioso tío Vernon de ''Harry Potter'', pero Richard Griffiths ya tenía una larga carrera en los escenarios, la televisión y el cine de Reino Unido. El veterano actor ha fallecido esta semana en el Hospital Universitario de Coventry and Warwickshire a los 65 años debido a complicaciones derivadas de una operación coronaria según informó la BBC.\nRichard Griffiths comenzó su carrera actoral en la Royal Shakespeare Company, donde se especializó en el papel de bufón clásico y debutó en la televisión en la serie ''Crown Court''. Se hizo mundialmente conocido con la saga ''Harry Potter'', pero anteriormente interpretó al tío Monty en ''Withnail y yo'', que se convirtió en una película de culto en Reino Unido.\nSus cuarenta años de profesión le han valido un premio Tony, un premio Oliver (ambos en 2006 por interpretar al profesor Hector en la obra de teatro ''The History Boys'' de Alan Bennett) y en 2008 fue condecorado con un OBE (Orden del Imperio Británico) en la lista de honores que concede anualmente la reina Isabel II por su contribución artística.\nSus compañeros de profesión le han rendido tributo tanto en persona como en las distintas redes sociales. Daniel Radcliffe fue el primero en hacerlo, comenta la BBC, recordando que Griffiths estuvo a su lado ''en los dos momentos más importante de mi carrera (en la saga ''Harry Potter'' y en la obra teatral ''Equus'').Y estoy orgulloso de haberle conocido''. El joven actor valoraba mucho su ''valor y su humor'' que hacían del trabajo ''un placer'' durante los rodajes. ''Su sola presencia en cualquier sala hacía que el lugar fuera el doble de divertido e inteligente''.', 'richard_vernon.jpg', '', '2013-04-01', NULL, NULL),
(2, 'Iron Man 3 tendrá versión exclusiva para China', 'Walt Disney coproducirá con el estudio chino DMG Entertainment una versión exclusiva para el país con metraje nuevo.', 'El mercado chino es muy suculento para las grandes superproducciones hollywoodienses, pero el veto del gobierno no permite estrenar más de 34 filmes extranjeros por año y además se controlan las recaudaciones. Pero aun así, en 2012, las ganancias en la taquilla china de las películas hollywoodenses superaron a las registradas en Japón. Las dos primeras versiones de ''Iron Man'' acumularon ganancias mundiales de 1.210 millones de dólares, de los que 42,8 millones procedieron de las salas de cine chinas.\nCon todo esto, algunas producciones optan por coproducir la película con China para resultar en un producto domestico que tenga las mismas opciones que los demás films del país. Eso es lo que ha hecho Disney para ''Iron Man 3'', según South China Morning Post. Marvel no ha querido pronunciarse al respecto y la portavoz de su grupo principal de comunicaciones, Melissa Zukerman, comunicará que su compañía no comentará acerca de las razones para la creación de dos versiones del filme, las diferencias entre éstas, o cuándo se estrenarán en el mercado chino.\n''Iron Man 3'' fue rodada parcialmente en China, en Pekín, el pasado diciembre en colaboración con el estudio chino, DMG Entertainment. Ahora esa colaboración se ha convertido en una coproducción en exclusiva para el público chino. Así, la nueva película habrá de atenerse a las condiciones del gobierno chino para las coproducciones, como que la tercera parte del reparto sea originaria del país y que incluya contenido cultural de China.\nDe momento ya se incluye a la popular estrella del cine chino Fan Bingbing en el nuevo metraje de la película que aun está por rodarse, mientras que el actor actor Wang Xueqi aparecerá en las dos versiones como el Dorctor Wu. Ben Kingsley interpreta a ''El Mandarín'', el malo de la película. Lo hace en compañía de las nuevas caras de la saga: Guy Pearce, que da vida a Aldrich Killian, un experto en ingeniería genética; Rebecca Hall que encarna a la científica Maya Hansen; y James Badge Dale, qui', 'ironman3.jpg', '', '2013-04-01', NULL, NULL),
(3, 'Legolas vuelve a la Tierra Media', 'Peter Jackson ya está dirigiendo la secuela de ''El Hobbit: Un viaje inesperado'', para la que recupera al Legolas de Orlando Bloom. Evangelin', 'Legolas, o sea, Orlando Bloom, vuelve a la Tierra Media. Aunque en ''El Hobbit'' que escribió J.R.R. Tolkien el personaje, uno de los protagonistas de ''El Señor de los Anillos'', no aparecía, Peter Jackson lo ha incorporado a la secuela de ''El Hobbit: Un viaje inesperado'', que se estrenará a finales de año.\nPero Bloom no es el único fichaje de lujo para ''El Hobbit: La desolación de Smaug''; al lado del actor británico encontramos a Lee Pace (''Lincoln''), que interpreta a su padre, el rey elfo Thranduil, Luke Evans (''El enigma del Cuervo''), que se pone en la piel de un arquero, y la televisiva (''Perdidos'') Evangeline Lilly, una elfa que ganará importancia en el tercer film de la trilogía. Las primeras imágenes del rodaje del film, que vuelve a protagonizar Martin Freeman como Bilbo Bolsón, ya se han hecho públicas.', 'legolas.jpg', '', '2013-04-02', 5, NULL),
(8, 'Jason Statham: del trampolín a la acción', 'Empezó como saltador profesional de trampolín hasta que fue descubierto por la moda y la publicidad y, más tarde, por el cine. Guy Ritchie l', 'Empezó como saltador profesional de trampolín hasta que fue descubierto por la moda y la publicidad y, más tarde, por el cine. Guy Ritchie le dio la alternativa con ''Lock & Stock'', y, 15 años después, Jason Statham ya es toda una estrella del cine de acción más destroyer que este mes estrena ''Parker''. por Sergi Rodríguez.\nTras su segundo film con Ritchie, Statham se fue ganando poco a poco un lugar como icono cañero de serie B. Así, repartió mamporros en ''El Único'' (James Wong, 2001), ''Cellular'' (David R. Ellis, 2004) o ''El asesino'' (Philip G. Atwell, 2007). Pero los films que le catapultaron como héroe macarra fueron las tres partes de ''Transporter'' y las dos de ''Crank''. ''Sé que nunca voy a ganar un Oscar por hacer películas como Crank (Mark Neveldine y Brian Taylor, 2006), y desde luego tampoco lo ganaré por las otras que he hecho...''', 'statham_noticia.jpg', '', '2013-04-02', 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE IF NOT EXISTS `peliculas` (
  `ID_PELICULA` int(11) NOT NULL AUTO_INCREMENT,
  `TITULO` varchar(50) NOT NULL,
  `DESCRIPCION` varchar(140) NOT NULL,
  `CRITICA` varchar(2000) NOT NULL,
  `ANIO` int(4) NOT NULL,
  `DURACION` int(3) NOT NULL,
  `DIRECTOR` varchar(50) NOT NULL,
  `PAIS` varchar(30) NOT NULL,
  `IMAGEN` varchar(30) NOT NULL,
  `VIDEO` varchar(60) NOT NULL,
  `ESTRENO` tinyint(1) NOT NULL,
  `PRECIO` decimal(5,2) NOT NULL,
  PRIMARY KEY (`ID_PELICULA`),
  UNIQUE KEY `UK_PELICULAS` (`TITULO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`ID_PELICULA`, `TITULO`, `DESCRIPCION`, `CRITICA`, `ANIO`, `DURACION`, `DIRECTOR`, `PAIS`, `IMAGEN`, `VIDEO`, `ESTRENO`, `PRECIO`) VALUES
(1, 'El caballero oscuro: La leyenda renace', 'Hace ocho años que Batman desapareció, dejando de ser un héroe para convertirse en un fugitivo. Al asumir la culpa por la muerte', 'Hace ocho años que Batman desapareció, dejando de ser un héroe para convertirse en un fugitivo. Al asumir la culpa por la muerte del fiscal del distrito Harvey Dent, el Caballero Oscuro decidió sacrificarlo todo por lo que consideraba, al igual que el Comisario Gordon, un bien mayor. La mentira funciona durante un tiempo, ya que la actividad criminal de la ciudad de Gotham se ve aplacada gracias a la dura Ley Dent. Pero todo cambia con la llegada de una astuta gata ladrona que pretende llevar a cabo un misterioso plan. Sin embargo, mucho más peligrosa es la aparición en escena de Bane, un terrorista enmascarado cuyos despiadados planes obligan a Bruce a regresar de su voluntario exilio.', 2012, 164, 'Christopher Nolan', 'EEUU', 'batman3.jpg', 'http://www.youtube.com/watch?v=tc2CxEaqkig', 0, 16.99),
(2, 'Los mercenarios 2', 'Barney Ross (Sylvester Stallone), Lee Christmas (Jason Statham), Yin Yang (Jet Li), Gunner Jensen (Dolph Lundgren), Toll Road (Randy Couture', 'Barney Ross (Sylvester Stallone), Lee Christmas (Jason Statham), Yin Yang (Jet Li), Gunner Jensen (Dolph Lundgren), Toll Road (Randy Couture) y Hale Caesar (Terry Crews) y Billy (Hemsworth), un nuevo colega, se vuelven a reunir cuando el señor Church (Bruce Willis) les encarga un trabajo aparentemente sencillo y muy lucrativo. Sin embargo, el plan se tuerce cuando un peligroso terrorista llamado Villain (Jean-Claude Van Damme) les tiende una emboscada. Entonces su único deseo será vengarse. Así es como van sembrando a su paso la destrucción y el caos entre sus enemigos hasta que se encuentran con una amenaza inesperada: cinco toneladas de plutonio apto para uso militar, una cantidad más que suficiente para cambiar el equilibrio de poder en el mundo.', 2012, 102, 'Simon West', 'EEUU', 'mercenarios2.jpg', 'http://www.youtube.com/watch?v=kRzyPZt5uCY', 0, 16.99),
(3, 'Avatar', 'Año 2154. Jake Sully (Sam Worthington), un ex-marine condenado a vivir en una silla de ruedas, sigue siendo, a pesar de ello, un auténtico g', 'Año 2154. Jake Sully (Sam Worthington), un ex-marine condenado a vivir en una silla de ruedas, sigue siendo, a pesar de ello, un auténtico guerrero. Precisamente por ello ha sido designado para ir a Pandora, donde algunas empresas están extrayendo un mineral extraño que podría resolver la crisis energética de la Tierra. Para contrarrestar la toxicidad de la atmósfera de Pandora, se ha creado el programa Avatar, gracias al cual los seres humanos mantienen sus conciencias unidas a un avatar: un cuerpo biológico controlado de forma remota que puede sobrevivir en el aire letal. Esos cuerpos han sido creados con ADN humano, mezclado con ADN de los nativos de Pandora, los Navi. Convertido en avatar, Jake puede caminar otra vez. Su misión consiste en infiltrarse entre los Navi, que se han convertido en el mayor obstáculo para la extracción del mineral. Pero cuando Neytiri, una bella Navi (Zoe Saldana), salva la vida de Jake, todo cambia: Jake, tras superar ciertas pruebas, es admitido en su clan. Mientras tanto, los hombres esperan los resultados de la misión de Jake.', 2009, 161, 'James Cameron', 'EEUU', 'avatar.jpg', 'http://www.youtube.com/watch?v=kbA9TfGphOI', 0, 15.50),
(4, 'Argo', 'Irán, año 1979. Cuando la embajada de los Estados Unidos en Teherán es ocupada por seguidores del Ayatolá Jomeini para pedir la extradición ', 'Irán, año 1979. Cuando la embajada de los Estados Unidos en Teherán es ocupada por seguidores del Ayatolá Jomeini para pedir la extradición del Sha de Persia, la CIA y el gobierno canadiense organizaron una operación para rescatar a seis diplomáticos estadounidenses que se habían refugiado en la casa del embajador de Canadá. Con este fin se recurrió a un experto en rescatar rehenes y se preparó el escenario para el rodaje de una película de ciencia-ficción, de título "Argo", en la que participaba un equipo de cazatalentos de Hollywood. La misión: ir a Teherán y hacer pasar a los diplomáticos por un equipo de filmación canadiense para traerlos de vuelta a casa.', 2012, 120, 'Ben Affleck', 'EEUU', 'argo.jpg', 'http://www.youtube.com/watch?v=Ou2JnNCys10', 1, 17.99),
(5, 'El Hobbit: un viaje inesperado', 'Precuela de la trilogía "El Señor de los Anillos", obra de J.R.R. Tolkien. En compañía del mago Gandalf y de trece enanos, el hobbit Bilbo B', 'Precuela de la trilogía "El Señor de los Anillos", obra de J.R.R. Tolkien. En compañía del mago Gandalf y de trece enanos, el hobbit Bilbo Bolsón emprende un viaje a través del país de los elfos y los bosques de los trolls, desde las mazmorras de los orcos hasta la Montaña Solitaria, donde el dragón Smaug esconde el tesoro de los Enanos. Finalmente, en las profundidades de la Tierra, encuentra el Anillo Único, hipnótico objeto que será posteriormente causa de tantas sangrientas batallas en la Tierra Media.', 2012, 169, 'Peter Jackson', 'EEUU', 'hobbit.jpg', 'http://www.youtube.com/watch?v=ZLYC9pdIumA', 0, 22.99),
(6, 'La vida de Pi', 'Tras un naufragio en medio del océano Pacífico, el joven hindú Pi, hijo de un guarda de zoo que viajaba de la India a Canadá, se encuentra e', 'Tras un naufragio en medio del océano Pacífico, el joven hindú Pi, hijo de un guarda de zoo que viajaba de la India a Canadá, se encuentra en un bote salvavidas con un único superviviente, un tigre de bengala con quien labrará una emocionante, increíble e inesperada relación.', 2012, 125, 'Ang Lee', 'EEUU', 'laVidaDePi.jpg', 'http://www.youtube.com/watch?v=HKuWAXffnk4', 0, 17.99),
(7, '007: Skyfall', 'La lealtad de James Bond (Daniel Craig), el mejor agente de los servicios británicos, hacia su superiora M (Judi Dench) se verá puesta a pru', 'La lealtad de James Bond (Daniel Craig), el mejor agente de los servicios británicos, hacia su superiora M (Judi Dench) se verá puesta a prueba cuando el pasado de ella vuelve para atormentarla. Al mismo tiempo, el MI6 sufre un ataque, y 007 tendrá que localizar y destruir el grave peligro que representa el villano Silva (Javier Bardem). Para conseguirlo contará con la ayuda de la agente Eve (Naomie Harris).', 2012, 143, 'Sam Mendes', 'Gran Bretaña', '007Skyfall.jpg', 'http://www.youtube.com/watch?v=GFnmF9cr98o', 0, 19.99),
(8, 'Lo imposible', 'Diciembre del año 2004. María (Naomi Watts), Henry (Ewan McGregor) y sus tres hijos pequeños vuelan desde Japón a Tailandia para pasar sus v', 'Diciembre del año 2004. María (Naomi Watts), Henry (Ewan McGregor) y sus tres hijos pequeños vuelan desde Japón a Tailandia para pasar sus vacaciones de Navidad descansando en la playa. Una mañana, mientras se encuentran todos en la piscina del complejo a orillas del mar, un tremendo tsunami destroza el hotel al mismo tiempo que gran parte de la costa del sudeste asiático. Las vidas de millones de personas cambiaron para siempre. Esta es la historia de esta familia.', 2012, 107, 'Juan Antonio Bayona', 'España', 'loImposible.jpg', 'http://www.youtube.com/watch?v=0E_oPirzJKM', 0, 16.99),
(9, 'El legado de Bourne', 'El agente Aaron Cross (Jeremy Renner) es otro producto creado por el eficiente programa Outcome. Los agentes de este programa han sido diseñ', 'El agente Aaron Cross (Jeremy Renner) es otro producto creado por el eficiente programa Outcome. Los agentes de este programa han sido diseñados y entrenados para funcionar en solitario en misiones altamente arriesgadas. Sin embargo, el programa se convierte en un peligro cuando se sabe que la historia de Bourne va a pasar a ser de dominio público. Entonces los altos mandos de la agencia, responsables de Treadstone y BlackBriar, deciden tomar una solución drástica.', 2012, 135, 'Tony Gilroy', 'EEUU', 'legadoDeBourne.jpg', 'http://www.youtube.com/watch?v=bcAqVP1ZpgE', 0, 16.99),
(10, 'Project X', 'Tres estudiantes de un instituto deciden organizar una fiesta salvaje en casa de uno de ellos, promocionándola en las redes sociales como la', 'Tres estudiantes de un instituto deciden organizar una fiesta salvaje en casa de uno de ellos, promocionándola en las redes sociales como la fiesta más loca de la temporada. Además, los chicos deciden grabarla para luego colgarla en la red. Pero, poco a poco, irán surgiendo una serie de complicaciones imprevistas.', 2012, 88, 'Nima Nourizadeh', 'EEUU', 'projectX.jpg', 'http://www.youtube.com/watch?v=jTiiHL97UQY', 0, 17.99),
(11, 'Sombras tenebrosas', 'En 1752, los Collins y su hijo Barnabas zarpan de Liverpool con destino a América para librarse de la misteriosa maldición que pesa sobre su', 'En 1752, los Collins y su hijo Barnabas zarpan de Liverpool con destino a América para librarse de la misteriosa maldición que pesa sobre su familia. Con el paso de los años, Barnabas (Johnny Depp), un playboy impenitente, se convierte en un hombre rico y poderoso que comete el error de romperle el corazón a Angelique Bouchard (Eva Green). Pero ella, que es una bruja, lo condena a un destino peor que la muerte: lo convierte en vampiro y lo entierra vivo. Dos siglos después, en 1972, Barnabas consigue salir de su tumba y se encuentra con un mundo irreconocible. Adaptación de la serie de televisión creada por Dan Curtis en 1966, que tuvo un remake en 1991.', 2012, 113, 'Tim Burton', 'EEUU', 'sombrasTenebrosas.jpg', 'http://www.youtube.com/watch?v=y4hAlxIZ0Fc', 0, 17.99),
(12, 'American Pie: El Reencuentro', 'Un grupo de viejos amigos vuelven a reunirse. Jim (Jason Biggs) y Michelle (Alyson Hannigan) siguen felizmente casados, aunque hay una vecin', 'Un grupo de viejos amigos vuelven a reunirse. Jim (Jason Biggs) y Michelle (Alyson Hannigan) siguen felizmente casados, aunque hay una vecina que se ha enamorado de él. Además, la cinta sexual con Nadia se ha convertido en uno de los videos más vistos de Youtube. Por su parte, Oz (Chris Klein) vive en una mansión de Malibú, pero su novia parece sólo interesada por su dinero. Mientras tanto, la vida de Stifler (Seann William Scott) sigue siendo un desastre. Heather (Mena Suvari) sale con un cirujano que intenta parecer más joven, y Finch (Eddie Kaye Thomas), que ha viajado por el mundo, intenta ligar con Trish, una camarera amiga de Michelle.', 2012, 113, 'Jon Hurwitz', 'EEUU', 'americanPie4.jpg', 'http://www.youtube.com/watch?v=1PmZl3E9y9o', 0, 9.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `NICK` varchar(15) NOT NULL,
  `CLAVE` varchar(50) NOT NULL,
  `ROL` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  UNIQUE KEY `UK_USUARIOS` (`NICK`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NICK`, `CLAVE`, `ROL`) VALUES
(1, 'PEPE', 'PEPE', 'VIS'),
(2, 'marina', 'marina', 'administrador'),
(3, 'david', 'david', 'registrado'),
(4, 'floyd', 'floyd', 'visitante'),
(5, 'dm9', 'dmKJvwSe7GvYw', 'registrado'),
(6, 'marinadm9', 'maRX6AR7Rm41k', 'registrado'),
(7, 'ddiaz', 'ddI1QJtbLo0kk', 'registrado'),
(9, 'fperez', 'fpeUlZ9DuE0Vo', 'registrado'),
(11, 'vero', 'veFrZfk6aVwK.', 'registrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE IF NOT EXISTS `ventas` (
  `ID_PELICULA` int(11) NOT NULL,
  `ID_USUARIO` int(11) NOT NULL,
  `FECHA_HORA` datetime NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  PRIMARY KEY (`ID_PELICULA`,`ID_USUARIO`,`FECHA_HORA`),
  KEY `FK_VENTAS_USUARIOS` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`ID_PELICULA`, `ID_USUARIO`, `FECHA_HORA`, `CANTIDAD`) VALUES
(1, 1, '2013-04-09 00:00:00', 5),
(1, 1, '2013-04-12 00:00:00', 3),
(1, 2, '2013-04-02 00:00:00', 10),
(2, 1, '2013-04-12 00:00:00', 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD CONSTRAINT `FK_ACCESO_USUARIOS` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`);

--
-- Filtros para la tabla `actua`
--
ALTER TABLE `actua`
  ADD CONSTRAINT `FK_ACTUA_ACTORES` FOREIGN KEY (`ID_ACTOR`) REFERENCES `actores` (`ID_ACTOR`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_ACTUA_PELICULAS` FOREIGN KEY (`ID_PELICULA`) REFERENCES `peliculas` (`ID_PELICULA`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `FK_COMENTARIOS_PELICULAS` FOREIGN KEY (`ID_PELICULA`) REFERENCES `peliculas` (`ID_PELICULA`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_COMENTARIOS_USUARIOS` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE;

--
-- Filtros para la tabla `datos`
--
ALTER TABLE `datos`
  ADD CONSTRAINT `FK_DATOS_USUARIOS` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`) ON DELETE CASCADE;

--
-- Filtros para la tabla `gen_pel`
--
ALTER TABLE `gen_pel`
  ADD CONSTRAINT `FK_GEN_PEL_GENEROS` FOREIGN KEY (`ID_GENERO`) REFERENCES `generos` (`ID_GENERO`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_GEN_PEL_PELICULAS` FOREIGN KEY (`ID_PELICULA`) REFERENCES `peliculas` (`ID_PELICULA`) ON DELETE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `FK_NOTICIAS_ACTORES` FOREIGN KEY (`ID_ACTOR`) REFERENCES `actores` (`ID_ACTOR`),
  ADD CONSTRAINT `FK_NOTICIAS_PELICULAS` FOREIGN KEY (`ID_PELICULA`) REFERENCES `peliculas` (`ID_PELICULA`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `FK_VENTAS_PELICULAS` FOREIGN KEY (`ID_PELICULA`) REFERENCES `peliculas` (`ID_PELICULA`),
  ADD CONSTRAINT `FK_VENTAS_USUARIOS` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuarios` (`ID_USUARIO`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

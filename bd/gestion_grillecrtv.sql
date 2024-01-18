/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  17/03/2020 11:14:37                      */
/*==============================================================*/

use gestion_grillecrtv;

drop table if exists ANTENNE;

drop table if exists CHAINE;

drop table if exists DIFFUSION;

drop table if exists EQUIPEPRODUCTION;

drop table if exists GENREPROGRAMME;

drop table if exists GRILLE;

drop table if exists JOUR;

drop table if exists JOURNALISTE;

drop table if exists LANGUEDIFFUSIONP;

drop table if exists PROGRAMME;

drop table if exists REGISSEUR;

drop table if exists TYPEEQUIPEP;

drop table if exists TYPEGRILLE;

drop table if exists TYPEPROGRAMME;

/*==============================================================*/
/* Table : ANTENNE                                              */
/*==============================================================*/
create table ANTENNE
(
   IDANTENNE            int not null AUTO_INCREMENT,
   MATRICULEREGISSEUR   varchar(10) not null,
   IDCHAINE             int not null,
   NOMANTENNE           varchar(100),
   primary key (IDANTENNE)
);

/*==============================================================*/
/* Table : CHAINE                                               */
/*==============================================================*/
create table CHAINE
(
   IDCHAINE             int not null AUTO_INCREMENT,
   NOMCHAINE            varchar(100),
   primary key (IDCHAINE)
);

/*==============================================================*/
/* Table : DIFFUSION                                            */
/*==============================================================*/
create table DIFFUSION
(
   IDDIFFUSION          int not null AUTO_INCREMENT,
   IDANTENNE            int not null,
   IDPROGRAMME          int not null,
   CODEJOUR             varchar(3) not null,
   DATEDIFFUSION        date,
   HEUREEBUTDIFFUSION   time,
   HEUREFINDIFFUSION    time,
   primary key (IDDIFFUSION)
);

/*==============================================================*/
/* Table : EQUIPEPRODUCTION                                     */
/*==============================================================*/
create table EQUIPEPRODUCTION
(
   IDEQUIPEPRODUCTION   int not null AUTO_INCREMENT,
   CODETYPEEQUIPEP      varchar(5) not null,
   NOMEQUIPEPRODUCTION  varchar(100),
   ADRESSEEQUIPEPRODUCTION varchar(100),
   TELEQUIPEPRODUCTION  varchar(25),
   primary key (IDEQUIPEPRODUCTION)
);

/*==============================================================*/
/* Table : GENREPROGRAMME                                       */
/*==============================================================*/
create table GENREPROGRAMME
(
   CODEGENREPROGRAMME   varchar(5) not null,
   LIBELLEGENREPROGRAMME varchar(100),
   primary key (CODEGENREPROGRAMME)
);

/*==============================================================*/
/* Table : GRILLE                                               */
/*==============================================================*/
create table GRILLE
(
   IDGRILLE             int not null AUTO_INCREMENT,
   IDCHAINE             int not null,
   CODETYPEGRILLE       varchar(5) not null,
   NOMGRILLE            varchar(100),
   DATELANCEMENTGRILLE  date,
   DATEFINGRILLE        date,
   primary key (IDGRILLE)
);

/*==============================================================*/
/* Table : JOUR                                                 */
/*==============================================================*/
create table JOUR
(
   CODEJOUR             varchar(3) not null,
   LIBELLEJOUR          varchar(25),
   primary key (CODEJOUR)
);

/*==============================================================*/
/* Table : JOURNALISTE                                          */
/*==============================================================*/
create table JOURNALISTE
(
   MATRICULEJOURNALISTE varchar(10) not null,
   NOMJOURNALISTE       varchar(100),
   PRENOMJOURNALISTE    varchar(25),
   IMAGEPHOTOJOURNALISTE longblob,
   TELJOURNALISTE       varchar(25),
   primary key (MATRICULEJOURNALISTE)
);

/*==============================================================*/
/* Table : LANGUEDIFFUSIONP                                     */
/*==============================================================*/
create table LANGUEDIFFUSIONP
(
   CODELANGUEDIFFUSIONP varchar(3) not null,
   LIBELLELANGUEDIFFUSIONP varchar(100),
   primary key (CODELANGUEDIFFUSIONP)
);

/*==============================================================*/
/* Table : PROGRAMME                                            */
/*==============================================================*/
create table PROGRAMME
(
   IDPROGRAMME          int not null AUTO_INCREMENT,
   IDGRILLE             int not null,
   CODELANGUEDIFFUSIONP varchar(3) not null,
   CODETYPEPROGRAMME    varchar(5) not null,
   IDEQUIPEPRODUCTION   int not null,
   CODEGENREPROGRAMME   varchar(5) not null,
   MATRICULEJOURNALISTE varchar(10) not null,
   NOMPROGRAMME         varchar(100),
   IMAGEPROGRAMME       longblob,
   DUREEPROGRAMME       int,
   primary key (IDPROGRAMME)
);

/*==============================================================*/
/* Table : REGISSEUR                                            */
/*==============================================================*/
create table REGISSEUR
(
   MATRICULEREGISSEUR   varchar(10) not null,
   NOMREGISSEUR         varchar(50),
   PRENOMREGISSEUR      varchar(25),
   TELREGISSEUR         varchar(25),
   primary key (MATRICULEREGISSEUR)
);

/*==============================================================*/
/* Table : TYPEEQUIPEP                                          */
/*==============================================================*/
create table TYPEEQUIPEP
(
   CODETYPEEQUIPEP      varchar(5) not null,
   LIBELLETYPEEQUIPEP   varchar(100),
   primary key (CODETYPEEQUIPEP)
);

/*==============================================================*/
/* Table : TYPEGRILLE                                           */
/*==============================================================*/
create table TYPEGRILLE
(
   CODETYPEGRILLE       varchar(5) not null,
   LIBELLETYPEGRILLE    varchar(100),
   primary key (CODETYPEGRILLE)
);

/*==============================================================*/
/* Table : TYPEPROGRAMME                                        */
/*==============================================================*/
create table TYPEPROGRAMME
(
   CODETYPEPROGRAMME    varchar(5) not null,
   LIBELLETYPEPROGRAMME varchar(100),
   primary key (CODETYPEPROGRAMME)
);

alter table ANTENNE add constraint FK_GERER foreign key (MATRICULEREGISSEUR)
      references REGISSEUR (MATRICULEREGISSEUR) on delete restrict on update restrict;

alter table ANTENNE add constraint FK_POSSEDER foreign key (IDCHAINE)
      references CHAINE (IDCHAINE) on delete restrict on update restrict;

alter table DIFFUSION add constraint FK_ASSOCIER foreign key (IDPROGRAMME)
      references PROGRAMME (IDPROGRAMME) on delete restrict on update restrict;

alter table DIFFUSION add constraint FK_DEROULER foreign key (CODEJOUR)
      references JOUR (CODEJOUR) on delete restrict on update restrict;

alter table DIFFUSION add constraint FK_PROGRAMMER foreign key (IDANTENNE)
      references ANTENNE (IDANTENNE) on delete restrict on update restrict;

alter table EQUIPEPRODUCTION add constraint FK_PROVENIR foreign key (CODETYPEEQUIPEP)
      references TYPEEQUIPEP (CODETYPEEQUIPEP) on delete restrict on update restrict;

alter table GRILLE add constraint FK_APPARTENIR foreign key (CODETYPEGRILLE)
      references TYPEGRILLE (CODETYPEGRILLE) on delete restrict on update restrict;

alter table GRILLE add constraint FK_DISPOSER foreign key (IDCHAINE)
      references CHAINE (IDCHAINE) on delete restrict on update restrict;

alter table PROGRAMME add constraint FK_AVOIR foreign key (CODEGENREPROGRAMME)
      references GENREPROGRAMME (CODEGENREPROGRAMME) on delete restrict on update restrict;

alter table PROGRAMME add constraint FK_CLASSER foreign key (CODETYPEPROGRAMME)
      references TYPEPROGRAMME (CODETYPEPROGRAMME) on delete restrict on update restrict;

alter table PROGRAMME add constraint FK_COMPRENDRE foreign key (IDGRILLE)
      references GRILLE (IDGRILLE) on delete restrict on update restrict;

alter table PROGRAMME add constraint FK_CORRESPONDRE foreign key (CODELANGUEDIFFUSIONP)
      references LANGUEDIFFUSIONP (CODELANGUEDIFFUSIONP) on delete restrict on update restrict;

alter table PROGRAMME add constraint FK_PRESENTER foreign key (MATRICULEJOURNALISTE)
      references JOURNALISTE (MATRICULEJOURNALISTE) on delete restrict on update restrict;

alter table PROGRAMME add constraint FK_PRODUIRE foreign key (IDEQUIPEPRODUCTION)
      references EQUIPEPRODUCTION (IDEQUIPEPRODUCTION) on delete restrict on update restrict;


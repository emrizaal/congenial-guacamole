/*==============================================================*/
/* DBMS name:      MySQL 4.0                                    */
/* Created on:     11/15/2016 12:28:37 PM                       */
/*==============================================================*/


drop table if exists ADMIN;

drop table if exists ARTICLE;

drop table if exists ATTEND;

drop table if exists EBOOK;

drop table if exists FEEDBACK;

drop table if exists KAJIAN;

drop table if exists MEMBER;

drop table if exists MOSQUE;

drop table if exists SLIDER;

drop table if exists SUBSCRIBE;

drop table if exists USTADZ;

/*==============================================================*/
/* Table: ADMIN                                                 */
/*==============================================================*/
create table ADMIN
(
   USERNAME                       varchar(1024),
   PASSWORD                       varchar(40)
);

/*==============================================================*/
/* Table: MOSQUE                                                */
/*==============================================================*/
create table MOSQUE
(
   ID_MOSQUE                      int                            not null AUTO_INCREMENT,
   USERNAME                       varchar(1024),
   PASSWORD                       varchar(40),
   NAME                           varchar(1024),
   LONGITUDE                      text,
   LATITUDE                       text,
   URL                            varchar(1024),
   ADDRESS                        text,
   TELP                           varchar(1024),
   EMAIL                          varchar(1024),
   KAJIAN                         bool,
   USTADZ                         bool,
   EBOOK                          bool,
   ARTICLE                        bool,
   SLIDER                         bool,
   PIC                            text,
   POPUP                          text,
   primary key (ID_MOSQUE)
);

/*==============================================================*/
/* Table: ARTICLE                                               */
/*==============================================================*/
create table ARTICLE
(
   ID_ARTICLE                     int                            not null AUTO_INCREMENT,
   ID_MOSQUE                      int,
   TITLE                          varchar(1024),
   DATE_START                     datetime,
   CONTENT                        text,
   PIC                            text,
   primary key (ID_ARTICLE),
   constraint FK_RELATIONSHIP_10 foreign key (ID_MOSQUE)
      references MOSQUE (ID_MOSQUE)
);

/*==============================================================*/
/* Table: MEMBER                                                */
/*==============================================================*/
create table MEMBER
(
   ID_MEMBER                      int                            not null AUTO_INCREMENT,
   EMAIL                          varchar(1024),
   primary key (ID_MEMBER)
);

/*==============================================================*/
/* Table: USTADZ                                                */
/*==============================================================*/
create table USTADZ
(
   ID_USTADZ                      int                            not null AUTO_INCREMENT,
   ID_MOSQUE                      int,
   NAME                           varchar(1024),
   DESCRIPTION                    text,
   PIC                            text,
   primary key (ID_USTADZ),
   constraint FK_RELATIONSHIP_9 foreign key (ID_MOSQUE)
      references MOSQUE (ID_MOSQUE)
);

/*==============================================================*/
/* Table: KAJIAN                                                */
/*==============================================================*/
create table KAJIAN
(
   ID_KAJIAN                      int                            not null AUTO_INCREMENT,
   ID_USTADZ                      int,
   ID_MOSQUE                      int,
   NAME                           varchar(1024),
   PLACE                          char(10),
   DESCRIPTION                    text,
   DATE_START                     datetime,
   DATE_END                       datetime,
   URL                            varchar(1024),
   PIC                            text,
   primary key (ID_KAJIAN),
   constraint FK_RELATIONSHIP_1 foreign key (ID_MOSQUE)
      references MOSQUE (ID_MOSQUE),
   constraint FK_RELATIONSHIP_8 foreign key (ID_USTADZ)
      references USTADZ (ID_USTADZ)
);

/*==============================================================*/
/* Table: ATTEND                                                */
/*==============================================================*/
create table ATTEND
(
   ID_KAJIAN                      int,
   ID_MEMBER                      int,
   constraint FK_RELATIONSHIP_5 foreign key (ID_MEMBER)
      references MEMBER (ID_MEMBER),
   constraint FK_RELATIONSHIP_6 foreign key (ID_KAJIAN)
      references KAJIAN (ID_KAJIAN)
);

/*==============================================================*/
/* Table: EBOOK                                                 */
/*==============================================================*/
create table EBOOK
(
   ID_EBOOK                       int                            not null AUTO_INCREMENT,
   ID_MOSQUE                      int,
   TITLE                          varchar(1024),
   DESCRIPTION                    text,
   URL                            varchar(1024),
   PIC                            text,
   primary key (ID_EBOOK),
   constraint FK_RELATIONSHIP_11 foreign key (ID_MOSQUE)
      references MOSQUE (ID_MOSQUE)
);

/*==============================================================*/
/* Table: FEEDBACK                                              */
/*==============================================================*/
create table FEEDBACK
(
   ID_FEEDBACK                    int                            not null AUTO_INCREMENT,
   ID_MEMBER                      int,
   CONTENT                        text,
   primary key (ID_FEEDBACK),
   constraint FK_RELATIONSHIP_7 foreign key (ID_MEMBER)
      references MEMBER (ID_MEMBER)
);

/*==============================================================*/
/* Table: SLIDER                                                */
/*==============================================================*/
create table SLIDER
(
   ID_SLIDER                      int                            not null AUTO_INCREMENT,
   ID_MOSQUE                      int,
   PIC                            text,
   STATUS                         bool,
   primary key (ID_SLIDER),
   constraint FK_RELATIONSHIP_12 foreign key (ID_MOSQUE)
      references MOSQUE (ID_MOSQUE)
);

/*==============================================================*/
/* Table: SUBSCRIBE                                             */
/*==============================================================*/
create table SUBSCRIBE
(
   ID_MEMBER                      int,
   ID_MOSQUE                      int,
   constraint FK_RELATIONSHIP_3 foreign key (ID_MOSQUE)
      references MOSQUE (ID_MOSQUE),
   constraint FK_RELATIONSHIP_4 foreign key (ID_MEMBER)
      references MEMBER (ID_MEMBER)
);


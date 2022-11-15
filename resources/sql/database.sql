CREATE DATABASE kardex;

USE kardex;

CREATE TABLE tp_genero (
	id_genero	int(10)	 NOT NULL AUTO_INCREMENT,
    genero		varchar(20)	NOT NULL,
    PRIMARY KEY (id_genero)
);

CREATE TABLE ult_estudios (
	id_estudio	int(10) NOT NULL AUTO_INCREMENT,
    estudio	varchar(30) NOT NULL,
    PRIMARY KEY (id_estudio)
);

CREATE TABLE semestre (
	id_semestre	int(10) NOT NULL AUTO_INCREMENT,
    semestre	varchar(20) NOT NULL,
    PRIMARY KEY (id_semestre)
);

CREATE TABLE alumno (
    id_alumno		int(10)	NOT NULL AUTO_INCREMENT,
    nombre_alum		varchar(50)	NOT NULL,
    ap_pat_alum		varchar(50)	NOT NULL,
    ap_mat_alum		varchar(50)	NOT NULL,
    fch_nac_alum	date NOT NULL,
    edad_alum		int(10)	NOT NULL,
    domic_alum		varchar(100) NOT NULL,
    telef_alum		int(10) NOT NULL,
    correo_alum		varchar(70)	NOT NULL,
    id_estudio		int(10) NOT NULL,
    id_genero		int(10)	NOT NULL,
    id_semestre		int(10)	NOT NULL,
    PRIMARY KEY (id_alumno),
    FOREIGN KEY (id_estudio) REFERENCES ult_estudios(id_estudio),
    FOREIGN KEY (id_genero) REFERENCES tp_genero(id_genero),
    FOREIGN KEY (id_semestre) REFERENCES semestre(id_semestre)
);

CREATE TABLE archivos (
	id_archivo		int(10) NOT NULL AUTO_INCREMENT,
    archivo			mediumblob NOT NULL,
    mimetp_archivo	varchar(50)	NOT NULL,
    fecha_reg_arc	date NOT NULL,
    PRIMARY KEY (id_archivo)
);

CREATE TABLE kardex (
	id_kardex		int(10) NOT NULL AUTO_INCREMENT,
    fch_reg_kardex	date	NOT NULL,
    id_alumno		int(10) NOT NULL,
    id_arc_curp		int(10)	NOT NULL,
    id_arc_cmpbnt	int(10)	NOT NULL,
    id_arc_foto		int(10)	NOT NULL,
    id_arc_certf	int(10) NOT NULL,
    id_arc_pdf      int(10) NOT NULL,
    PRIMARY KEY (id_kardex),
    FOREIGN KEY (id_alumno) REFERENCES alumno(id_alumno),
    FOREIGN KEY (id_arc_curp) REFERENCES archivos(id_archivo),
    FOREIGN KEY (id_arc_cmpbnt) REFERENCES archivos(id_archivo),
    FOREIGN KEY (id_arc_foto) REFERENCES archivos(id_archivo),
    FOREIGN KEY (id_arc_certf) REFERENCES archivos(id_archivo),
    FOREIGN KEY (id_arc_pdf) REFERENCES archivos(id_archivo)
);
CREATE VIEW view_kardex AS
SELECT  k.id_kardex AS id_kardex, k.fch_reg_kardex AS FechaReg,
        a.id_alumno AS  Matricula, a.nombre_alum AS NombreAlu, a.ap_pat_alum AS ApPaterno, a.ap_mat_alum AS ApMaterno,
        a.fch_nac_alum AS FechaNac, a.edad_alum AS Edad, a.domic_alum AS Domicilio, a.telef_alum AS Telefono, a.correo_alum AS Correo,
        s.semestre AS Semestre, g.genero AS Genero, e.estudio AS Estudio,
        f1.id_archivo AS id_archivo1, f1.archivo AS Archivo1, f1.mimetp_archivo AS TypeArchivo1, f1.fecha_reg_arc AS FechaRegArc1,
        f2.id_archivo AS id_archivo2, f2.archivo AS Archivo2, f2.mimetp_archivo AS TypeArchivo2, f2.fecha_reg_arc AS FechaRegArc2,
        f3.id_archivo AS id_archivo3, f3.archivo AS Archivo3, f3.mimetp_archivo AS TypeArchivo3, f3.fecha_reg_arc AS FechaRegArc3,
        f4.id_archivo AS id_archivo4, f4.archivo AS Archivo4, f4.mimetp_archivo AS TypeArchivo4, f4.fecha_reg_arc AS FechaRegArc4,
        f5.id_archivo AS id_archivo5, f5.archivo AS Archivo5, f5.mimetp_archivo AS TypeArchivo5, f5.fecha_reg_arc AS FechaRegArc5
FROM kardex AS  k
LEFT JOIN
alumno      AS  a
ON  k.id_alumno = a.id_alumno
LEFT JOIN
semestre    AS  s
ON  a.id_semestre = s.id_semestre
LEFT JOIN
tp_genero   AS  g
ON  a.id_genero = g.id_genero
LEFT JOIN
ult_estudios    AS e
ON  a.id_estudio = e.id_estudio
LEFT JOIN
archivos    AS  f1
ON  k.id_arc_curp = f1.id_archivo
LEFT JOIN
archivos    AS  f2
ON  k.id_arc_cmpbnt = f2.id_archivo
LEFT JOIN
archivos    AS  f3
ON  k.id_arc_foto = f3.id_archivo
LEFT JOIN
archivos    AS  f4
ON  k.id_arc_certf = f4.id_archivo
LEFT JOIN
archivos    AS  f5
ON  k.id_arc_pdf = f5.id_archivo
ORDER BY id_kardex DESC;

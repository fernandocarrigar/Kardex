CREATE VIEW view_alumno AS
SELECT  a.id_alumno AS id_alumno, a.nombre_alum AS Nombre_alum, a.ap_pat_aluM AS Ap_Paterno_alum, a.ap_mat_alum	AS Ap_Materno_alum, a.fch_nac_alum AS FechaNac_alum,
        a.edad_alum	AS Edad_alum, a.domic_alum AS Domicilio_alum, a.telef_alum AS Telefono_alum, a.correo_alum AS Correo_alum, e.estudio AS Estudio_alum, s.semestre AS Semestre_alum, g.genero AS Genero_alum
FROM alumno     AS a
LEFT JOIN
ult_estudios    AS e
ON  a.id_estudio = e.id_estudio
LEFT JOIN
semestre        AS s
ON  a.id_semestre = s.id_semestre
LEFT JOIN
tp_genero       AS g
ON  a.id_genero = g.id_genero
ORDER by id_alumno DESC;
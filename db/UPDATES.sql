-- Primera Update -> Julio 2022
-- Primera update, consta de agregar las notas de envio al sistema, lo cual debe agregarse el detalle en el corte de caja, facturacion, y reportes.

--Agregar campo de correlativo para notas de envio:
ALTER TABLE `correlativo` ADD `nota_envio` INT NOT NULL COMMENT 'notas de envio' AFTER `con`;

--Agregar campos para guardar los correlativos usados en controlcaja y monto vendido en concepto de notas de envío.
ALTER TABLE `controlcaja` ADD `total_notasenvio` DECIMAL(12,2) NOT NULL AFTER `totalnocf`;
ALTER TABLE `controlcaja` ADD `notasenvio_inicio` INT NOT NULL AFTER `cffinal`, ADD `notasenvio_final` INT NOT NULL AFTER `notasenvio_inicio`;


--//////===============================================================================


 CREATE  EVENT eliminaVencidos ON SCHEDULE EVERY 1 DAY STARTS '2021-03-31 23:59:00' ON COMPLETION NOT PRESERVE ENABLE 
 DO DELETE FROM mantenimiento.eventos 
 where eventos.periodicidad=0 AND eventos.fechaFin = (SELECT curdate())

 CREATE  EVENT modificaPeriodicos ON SCHEDULE EVERY 1 DAY STARTS '2021-03-31 23:59:00' ON COMPLETION NOT PRESERVE ENABLE 
 DO UPDATE mantenimiento.eventos set eventos.fechaFin = (select DATE_ADD(eventos.fechaFin, 
 INTERVAL eventos.periodicidad DAY)),eventos.fechaInicio = (select DATE_ADD(eventos.fechaInicio, INTERVAL eventos.periodicidad DAY)) 
 where eventos.periodicidad<>0 and eventos.fechaFin =(SELECT curdate())

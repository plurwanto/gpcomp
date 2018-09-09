SELECT d.HargaBeli FROM penjualan_detail d
INNER JOIN penjualan_header h
ON d.`IDTransaksi` = h.`IDTransaksi`
 WHERE d.HargaBeli = '59000' AND 
 h.`Tanggal` >= '2018-07-11 17:00:00'
 ;
 
UPDATE 
  penjualan_detail AS t1 
  INNER JOIN penjualan_header AS t2 
    ON t1.IDTransaksi = t2.IDTransaksi SET t1.HargaBeli = '59000' 
WHERE t1.HargaBeli = '61000' 
  AND t2.`Tanggal` >= '2018-07-11 17:00:00' 
  ;


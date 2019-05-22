USE direct_prod;

SELECT DISTINCT a.idAdvertisement FROM advertisements AS a, users AS u WHERE a.valid = 1 AND a.email = u.email AND 
a.title LIKE "%5%" AND a.description LIKE "%5%"  
OR 
u.city LIKE "%5%" AND u.canton LIKE "%5%" AND u.postCode LIKE "%5%"
OR
"5" = ( SELECT FORMAT(AVG(r.rating), 'N') FROM rates AS r WHERE r.idAdvertisement = a.idAdvertisement)
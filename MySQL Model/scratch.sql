SELECT filepath
FROM reviews
WHERE filepath IS NOT NULL 
AND building_id = 4;
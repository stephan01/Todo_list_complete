CREATE TABLE users
user_id Primary	    int(13)		      AUTO_INCREMENT		
username	          varchar(255)
password	          varchar(255)	


CREATE TABLE todos
task_id Primary	    int(11)					AUTO_INCREMENT	
task_description	  varchar(255)	
user_id	            int(11)			

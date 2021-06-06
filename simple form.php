<html>
    <body>

        <form action="simple form.php" method="POST">
        
            Name: <input type="text" name="name"> <br/> <br/>
           Email: <input type="text" name="email"> <br/> <br/>
	 Contact: <input type="number" name="contact"> <br/> <br/>
Parent's Contact: <input type="number" name="parent's contact"> <br/> <br/>
	    Address: <br/>
	    House no.: <input type="number" name="house no."> <br/> <br/>
	     Road no.: <input type="number" name="road no."> <br/> <br/>
	    Area Name: <input type="text" name="area name"> <br/> <br/>
	         City: <input type="text" name="city"> <br/> <br/>
	    
            
            About Me:<br/> 
            <textarea name="aboutme"></textarea> <br/>
            
            Gender: 
            <input type="radio" name="gender" value="female"> Female
            <input type="radio" name="gender" value="male"> Male
	    <input type="radio" name="gender" value="other">Other
            <br/>
            <input type="submit" name="submit" value="Press Here To Submit">
        </form>

    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/singUpForm.css">
    <title>Registro</title>
</head>
<body>
<div class="form-container">
<form action="../scripts/singUp_script.php" method="POST" class="form">
            <fieldset>
                <legend>Registrate</legend>

                <div>
                    <label for="username" >Username:</label>
                    <div>
                        <input type="text" id="username" name="username" required />
                    </div>
                </div>

                <div>
                    <label for="password" >Password:</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Debe contener al menos un número y una mayúscula y una minúscula, y al menos 8 caracteres"/>
                    </div>
                </div>
                <div >
                    <label for="email" >Email:</label>
                    <div>
                        <input type="email" id="email" name="email" required />
                    </div>
                <div  class="buttons">
                    <input id="sendBttn" type="submit" value="Registrarse" name="submit" class="button"/>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>
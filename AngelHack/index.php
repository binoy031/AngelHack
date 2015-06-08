<html>
<head>
<title>Test</title>
<style>
 h1 {
  color: #363432;
  font-family: 'Roboto', sans-serif;
  font-size: 41px;
  font-weight: 300;
}
form input {
  background:#F0F0E9;
  border: 0 none;
  color: #A6A6A1;
  font-family: 'Roboto', sans-serif;
  font-size: 14px;
  outline: medium none;
  padding: 8px;
  width: 30%;
}
button {
  background: #FE980F;
  border: medium none;
  border-radius: 0;
  margin-left: 23px;
  margin-top: 8px;
  padding: 10px 26px;
}</style>
</head>
<body>
<h1>Upload Data</h1>
<form action="testfinal.php" method="post">
<input type="text" placeholder="Name" name="name" /><br><br>
<input type="text" placeholder="Mobile Number"  name="mobno" /><br><br>
<input type="text" placeholder="Amount of Food"  name="amount" /><br><br>
<input type="text" placeholder="Latitude" name="latitude" /><br><br>
<input type="text" placeholder="Longitude" name="longitude" /><br><br>
<input type="text" placeholder="Status" name="status" /><br><br>
<button type="submit">Submit</button>
</form>
</body>
</html>
/* Global styles */
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.register-container {
  width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f2f2f2;
}

h1 {
  text-align: center;
}

.form-row {
  display: flex;
  justify-content: space-between;
}

.form-group {
  flex-basis: 48%;
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

input[type="text"],
input[type="password"],
input[type="email"],
input[type="tel"],
input[type="file"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

button.register-button {
  display: block;
  width: 100%;
  padding: 10px;
  font-size: 16px;
  background-color: #4caf50;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.error-message,
.success-message {
  margin-top: 10px;
  text-align: center;
}

.error-message {
  color: red;
}

.success-message {
  color: green;
}


<!DOCTYPE html>
<html>
<head>
    <title>MoMo USSD Simulator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>MoMo Pays</h2>

    <form method="post">
        <?php
        if (!isset($_POST['step'])) {
            echo '<label for="ussd">USSD goes here:</label><br>
            <input type="text" name="ussd" value="" id="ussd" required/>';
            echo '<input type="hidden" name="step" value="0">';
        }
        elseif ($_POST['step'] == 0) {
            if ($_POST['ussd'] == "*182#") {
                echo "<p>Main Menu</p>";
                echo "1. Send Money<br>";
                echo "2. Buy Electricity<br>";
                echo "3. Check Balance<br>";
                echo '<input type="text" name="menu" placeholder="Choose option" required />';
                echo '<input type="hidden" name="step" value="1">';
            } else {
                echo '<label for="ussd">USSD goes here:</label><br>
                   <input type="text" name="ussd" value="" id="ussd" required/>';
                echo '<input type="hidden" name="step" value="0">';
            }
        }
        elseif ($_POST['step'] == 1) {
            if ($_POST['menu'] == "1") {
                echo "Enter recipient number:<br>";
                echo '<input type="text" name="number" required />';
                echo '<input type="hidden" name="step" value="2">';
            } elseif ($_POST['menu'] == "2") {
                echo "Enter meter number:<br>";
                echo '<input type="text" name="meter" required />';
                echo '<input type="hidden" name="step" value="3">';
            } elseif ($_POST['menu'] == "3") {
                echo "<p>Your balance is 10,000 RWF</p>";
                echo '<button type="submit" name="reset">Start Again</button>';
            } else {
                echo "<p>Invalid option. Try again.</p>";
                echo '<input type="hidden" name="step" value="1">';
            }
        }
        elseif ($_POST['step'] == 2) {
            echo "Enter amount:<br>";
            echo '<input type="number" name="amount" required/>';
            echo '<input type="hidden" name="recipient" value="' . htmlspecialchars($_POST['number']) . '">';
            echo '<input type="hidden" name="step" value="4">';
        }
        elseif ($_POST['step'] == 4) {
            echo "<p>Sent {$_POST['amount']} to {$_POST['recipient']}</p>";
            echo "<p>Transaction Successful</p>";
            echo '<button type="submit" name="reset">Start Again</button>';
        }
        elseif ($_POST['step'] == 3) {
            echo "<p>Electricity purchased successfully for meter {$_POST['meter']}</p>";
            echo '<button type="submit" name="reset">Start Again</button>';
        }
        ?>
        <br><br>
        <input type="submit" value="send" id="send">
    </form>
    <section class="key-pad"></section>
    <script>
        const keyPadList = [1, 2, 3, 4, 5, 6, 7, 8, 9, "*", 0, "#"];
        const keyPads = document.querySelector(".key-pad");
        const ussd = document.querySelector("#ussd")
        const ussds = document.querySelectorAll("input")
        const send = document.querySelector("#send")
        keyPads.innerHTML = "";
      keyPadList.forEach((pad) => {
        keyPads.innerHTML += `<button id =${pad}>${pad}</button>`;
      });
      let counter = 0
      send.addEventListener("click", (e)=>{
        keyPads.innerHTML = ""
      })
       keyPads.addEventListener("click", (e) => {
        e.preventDefault();
        if (e.target.matches("button") && e.target.id !== "dial") {
          ussd.value += e.target.textContent;
        }
      });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Chatbot in PHP | CodingNepal</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.responsivevoice.org/responsivevoice.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>

    <!-- 
    <div class="texts">
    </div> -->


    <div class="wrapper">
        <div class="title">Simple Online Chatbot</div>
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="msg-header">
                    <p>Hello there, how can I help you?</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>


    <script>
        const texts = document.querySelector(".texts");

        window.SpeechRecognition =
            window.SpeechRecognition || window.webkitSpeechRecognition;

        const recognition = new SpeechRecognition();
        recognition.interimResults = true;

        // let p = document.createElement("p");

        recognition.addEventListener("result", (e) => {
            // texts.appendChild(p);
            var text = Array.from(e.results)
                .map((result) => result[0])
                .map((result) => result.transcript)
                .join("");

            // p.innerText = text;
            text = text.toLowerCase()
            console.log(text)
            if (e.results[0].isFinal) {
                if (text.includes(text)) {
                    $.ajax({
                        url: 'message.php',
                        type: 'POST',
                        data: 'text=' + text,
                        success: function(result) {
                            responsiveVoice.speak(
                                result,
                                "Indonesian Female", {
                                    pitch: 1,
                                    rate: 1,
                                    volume: 1
                                });
                            $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>' + result + '</p></div></div>';
                            $(".form").append($replay);
                            // when chat goes down the scroll bar automatically comes to the bottom
                            $(".form").scrollTop($(".form")[0].scrollHeight);
                        }
                    });
                }

                //     if (text.includes("indonesia")) {
                //         // p = document.createElement("p");
                //         // p.classList.add("replay");
                //         // p.innerText = "I am fine";
                //         // texts.appendChild(p);

                //     }
                //     if (
                //         text.includes("what's your name") ||
                //         text.includes("what is your name")
                //     ) {
                //         p = document.createElement("p");
                //         p.classList.add("replay");
                //         p.innerText = "My Name is Cifar";
                //         texts.appendChild(p);
                //     }
                //     if (text.includes("open my YouTube")) {
                //         p = document.createElement("p");
                //         p.classList.add("replay");
                //         p.innerText = "opening youtube channel";
                //         texts.appendChild(p);
                //         console.log("opening youtube");
                //         window.open("https://www.youtube.com/channel/UCdxaLo9ALJgXgOUDURRPGiQ");
                //     }
                //     p = document.createElement("p");
            }
            // console.log(camat)
        });
        recognition.addEventListener("end", () => {
            recognition.start();
        });

        recognition.start();
    </script>

    <script>
        $(document).ready(function() {
            $("#send-btn").on("click", function() {
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + $value + '</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');

                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text=' + $value,
                    success: function(result) {
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><i class="fas fa-user"></i></div><div class="msg-header"><p>' + result + '</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>

</body>

</html>
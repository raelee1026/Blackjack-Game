// <!--112550003 李昀祐 第四次作業 11/17 112550003 Yun-Yu, Lee The Fourth Homework 11/17 -->
let dealerSum = 0;
let yourSum = 0;

let dealerAceCount = 0;
let yourAceCount = 0; 

let hidden;
let deck;

let canHit = true; //allows the player (you) to draw while yourSum < 21

// for chips and bet
let chipBalance = 500;
let currentBet = 0;

window.onload = function() {
    preventReloadWithAlert();
    clearGameHistory();
    initializeGame();
    showElement("chip-controls");
    hideElement("game-controls");
    hideElement("history-container");

    // 綁定賭注按鈕的事件
    document.querySelectorAll(".chip").forEach(button => {
        button.disabled = false;
        button.addEventListener("click", function () {
            const betValue = parseInt(this.getAttribute("data-value"));
            console.log("Bet button clicked:", betValue);
            if (chipBalance >= betValue) {
                currentBet += betValue;
                chipBalance -= betValue;
                updateChipsDisplay();

                if (chipBalance === 0) {
                    document.querySelectorAll(".chip").forEach(btn => btn.disabled = true);
                }
            } else {
                // alert("Not enough chips for this bet.");
                showCenterMessageAlert("Not enough chips for this bet.");
            }
        });
    });

    // 綁定「開始遊戲」按鈕
    document.getElementById("start-game").addEventListener("click", function() {
        if (currentBet > 0) {
            startGame();
        } else {
            // alert("Please place a bet to start the game.");
            showCenterMessageAlert("Please place a bet to start the game.");
        }
    });

    // 綁定「Hit」和「Stand」按鈕
    document.getElementById("hit").addEventListener("click", hit);
    document.getElementById("stand").addEventListener("click", stand);
};

function initializeGame() {
    buildDeck();
    shuffleDeck();
    updateChipsDisplay();

    // 重置按鈕和顯示的狀態
    document.getElementById("dealer-cards").innerHTML = '<img id="hidden" src="./images/card_back.png">';
    document.getElementById("your-cards").innerHTML = "";
    document.getElementById("results").innerText = "";
    document.getElementById("your-sum").innerText = "";
    document.getElementById("dealer-sum").innerText = "";
    document.getElementById("hit").disabled = true;
    document.getElementById("stand").disabled = true;
}

function buildDeck() {
    let values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
    let types = ["C", "D", "H", "S"];
    deck = [];

    for (let i = 0; i < types.length; i++) {
        for (let j = 0; j < values.length; j++) {
            deck.push(values[j] + "-" + types[i]); //A-C -> K-C, A-D -> K-D
        }
    }
    // console.log(deck);
}

function shuffleDeck() {
    for (let i = 0; i < deck.length; i++) {
        let j = Math.floor(Math.random() * deck.length); // (0-1) * 52 => (0-51.9999)
        let temp = deck[i];
        deck[i] = deck[j];
        deck[j] = temp;
    }
    console.log(deck);
}

function startGame() {

    if (currentBet === 0) {
        // alert("Please place a bet to start the game.");
        return;
    }

    showElement("game-controls");
    hideElement("chip-controls");
    document.getElementById("start-game").style.display = "none";
    document.querySelectorAll(".chip").forEach(button => button.disabled = true);
    // 初始化或重置遊戲狀態
    initializeGame();
    canHit = true;
    dealerSum = 0;
    dealerAceCount = 0;
    yourSum = 0;
    yourAceCount = 0;

    // document.getElementById("dealer-cards").innerHTML = "";
    document.getElementById("your-cards").innerHTML = "";
    document.getElementById("results").innerText = "";
    document.getElementById("your-sum").innerText = "";
    document.getElementById("dealer-sum").innerText = "";
    document.getElementById("hit").disabled = false;
    document.getElementById("stand").disabled = false;

    // hide dealer first card
    hidden = deck.pop();
    dealerSum += getValue(hidden);
    dealerAceCount += checkAce(hidden);

    let cardImg = document.createElement("img");
    let card = deck.pop();
    cardImg.src = "./images/" + card + ".png";
    dealerSum += getValue(card);
    dealerAceCount += checkAce(card);
    document.getElementById("dealer-cards").append(cardImg);

    for (let i = 0; i < 2; i++) {
        let cardImg = document.createElement("img");
        let card = deck.pop();
        // let card = i === 0 ? "A-H" : "J-S"; //for blackjack checking
        cardImg.src = "./images/" + card + ".png";
        yourSum += getValue(card);
        yourAceCount += checkAce(card);
        document.getElementById("your-cards").append(cardImg);
    }

    // if player get 21 when start
    // if (reduceAce(yourSum, yourAceCount) === 21) {
    //     document.getElementById("results").innerText = "Blackjack! You Win!";
    //     document.getElementById("your-sum").innerText = yourSum;
    //     // can't use hit and stand
    //     document.getElementById("hit").disabled = true;
    //     document.getElementById("stand").disabled = true;
    //     return;
    // }

    if (reduceAce(yourSum, yourAceCount) === 21) {
        document.getElementById("your-sum").innerText = yourSum;
        document.getElementById("hit").disabled = true;
        document.getElementById("stand").disabled = true;
        setTimeout(() => {
            document.getElementById("hidden").src = "./images/" + hidden + ".png";
            showCenterMessage("Blackjack! You Win!");
            endGame("Blackjack! You Win!");
        }, 1000);
        
    }

    // // console.log(yourSum);
    // document.getElementById("hit").addEventListener("click", hit);
    // document.getElementById("stand").addEventListener("click", stand);

}

function hit() {
    if (!canHit) {
        return;
    }

    let cardImg = document.createElement("img");
    let card = deck.pop();
    cardImg.src = "./images/" + card + ".png";
    yourSum += getValue(card);
    yourAceCount += checkAce(card);
    document.getElementById("your-cards").append(cardImg);

    if (reduceAce(yourSum, yourAceCount) > 21) { //A, J, 8 -> 1 + 10 + 8
        canHit = false;
        document.getElementById("hit").disabled = true;
        document.getElementById("stand").disabled = true;
        document.getElementById("hidden").src = "./images/" + hidden + ".png";
        endGame();
    }

    else if (reduceAce(yourSum, yourAceCount) === 21) { //A, J, 8 -> 1 + 10 + 8
        canHit = false;
        document.getElementById("hit").disabled = true;
        document.getElementById("stand").disabled = true;
        document.getElementById("hidden").src = "./images/" + hidden + ".png";
        stand();
    }

}

function stand() {
    canHit = false;
    document.getElementById("hit").disabled = true;
    document.getElementById("stand").disabled = true;

    // show dealer hidden card
    document.getElementById("hidden").src = "./images/" + hidden + ".png";

    // start dealer draw
    setTimeout(function dealerDraw() {
        // count dealer and player sum
        let currentDealerSum = reduceAce(dealerSum, dealerAceCount);
        let currentYourSum = reduceAce(yourSum, yourAceCount);

        // if dealer should get cards
        // if (currentDealerSum < currentYourSum && currentDealerSum <= 21) {
        //     // dealer get cards
        //     let cardImg = document.createElement("img");
        //     let card = deck.pop();
        //     cardImg.src = "./images/" + card + ".png";
        //     dealerSum += getValue(card);
        //     dealerAceCount += checkAce(card);
        //     document.getElementById("dealer-cards").append(cardImg);

        //     // use setTimeout for next card
        //     setTimeout(dealerDraw, 1000); // wait 1 second for next card
        // } 
        if (currentDealerSum < 17) {
            // dealer get cards
            let cardImg = document.createElement("img");
            let card = deck.pop();
            cardImg.src = "./images/" + card + ".png";
            dealerSum += getValue(card);
            dealerAceCount += checkAce(card);
            document.getElementById("dealer-cards").append(cardImg);

            // use setTimeout for next card
            setTimeout(dealerDraw, 1000); // wait 1 second for next card
        } 
        else {
            // if dealer don't need card endgame
            endGame();
        }
    }, 1000); // after show hidden card 1 second start draw section
}

// endgame and show result
// function endGame() {
    
//     // count both final score
//     dealerSum = reduceAce(dealerSum, dealerAceCount);
//     yourSum = reduceAce(yourSum, yourAceCount);

//     // show final result
//     let message = "";
//     if (yourSum > 21) {
//         message = "You Lose!";
//     } else if (dealerSum > 21) {
//         message = "You Win!";
//     } else if (yourSum === dealerSum) {
//         message = "Tie!";
//     } else if (yourSum > dealerSum) {
//         message = "You Win!";
//     } else {
//         message = "You Lose!";
//     }

//     // show result in html
//     document.getElementById("dealer-sum").innerText = dealerSum;
//     document.getElementById("your-sum").innerText = yourSum;
//     document.getElementById("results").innerText = message;
    
//     updateChips(message);
//     updateChipsDisplay();
//     currentBet = 0;

//     // 設置延遲來顯示「開始遊戲」按鈕和賭注按鈕
//     setTimeout(() => {
//         // 顯示「開始遊戲」按鈕並啟用賭注按鈕
//         document.getElementById("start-game").style.display = "inline-block";
//         document.querySelectorAll(".chip").forEach(button => button.disabled = false);

//         // 再延遲顯示遊戲結束提示
//         setTimeout(() => {
//             if (chipBalance <= 0) {
//                 alert("Game over! You ran out of chips.");
//             } else {
//                 alert("Place a new bet to start the next game.");
//             }
//         }, 500); // 再延遲 0.5 秒顯示提示

//     }, 1000); // 初始延遲 1 秒顯示「開始遊戲」按鈕和賭注按鈕
// }

function endGame(result) {
    dealerSum = reduceAce(dealerSum, dealerAceCount);
    yourSum = reduceAce(yourSum, yourAceCount);

    let message = result || "";
    if (!message) {
        if (yourSum > 21) {
            message = "You Lose!";
            showCenterMessage("You Lose!");
        } else if (dealerSum > 21) {
            message = "You Win!";
            showCenterMessage("You Win!");
        } else if (yourSum === dealerSum) {
            message = "Tie!";
            showCenterMessage("Tie!");
        } else if (yourSum > dealerSum) {
            message = "You Win!";
            showCenterMessage("You Win!");
        } else {
            message = "You Lose!";
            showCenterMessage("You Lose!");
        }
    }

    // Display results
    document.getElementById("dealer-sum").innerText = dealerSum;
    document.getElementById("your-sum").innerText = yourSum;
    document.getElementById("results").innerText = message;

    saveGameInfo();
    // Update chips
    updateChips(message);
    currentBet = 0;
    updateChipsDisplay();
    // displayGameHistory();
    

    // Show start button and re-enable betting chips
    setTimeout(() => {
        document.getElementById("start-game").style.display = "inline-block";
        document.querySelectorAll(".chip").forEach(button => button.disabled = false);

        setTimeout(() => {
            if (chipBalance <= 0) {
                displayGameHistory();
                // alert("Game over! You ran out of chips.");
                showCenterMessage("Game over! You ran out of chips.");
                hideElement("chip-controls");
                hideElement("game-controls");
                showElement("history-container");
                // alert("Do you want to restart the game?");
                // window.location.reload();
            } 
            else {
                // alert("Place a new bet to start the next game.");
                showCenterMessage("Place a new bet to start the next game.");
                showElement("chip-controls");
                hideElement("game-controls");
            }
        }, 500);
    }, 1000);
}

function getValue(card) {
    let data = card.split("-"); // "4-C" -> ["4", "C"]
    let value = data[0];

    if (isNaN(value)) { //A J Q K
        if (value == "A") {
            return 11;
        }
        return 10;
    }
    return parseInt(value);
}

function checkAce(card) {
    if (card[0] == "A") {
        return 1;
    }
    return 0;
}

function reduceAce(playerSum, playerAceCount) {
    while (playerSum > 21 && playerAceCount > 0) {
        playerSum -= 10;
        playerAceCount -= 1;
    }
    return playerSum;
}

// display chips
function updateChipsDisplay() {
    document.getElementById("chip-balance").innerText = chipBalance;
    document.getElementById("current-bet").innerText = currentBet;
}

function updateChips(result) {
    if (result === "You Win!") {
        chipBalance += currentBet * 2; // 贏得兩倍賭注
    } 
    else if (result === "Blackjack! You Win!") {
        chipBalance += currentBet * 2;
    }
    else if (result === "Tie!") {
        chipBalance += currentBet; // 平局退還賭注
    }
    // 若結果為 "lose"，則不變，因為籌碼已經扣除

}

// local and session storage
function saveGameInfo() {
    const playerCards = Array.from(document.getElementById("your-cards").children).map(cardImg => {
        return cardImg.alt || cardImg.src.split("/").pop().split(".")[0]; // 假設每張牌的圖片名稱代表點數和花色
    });

    const dealerCards = Array.from(document.getElementById("dealer-cards").children).map(cardImg => {
        return cardImg.alt || cardImg.src.split("/").pop().split(".")[0]; // 同上
    });

    let result;
    if (yourSum > 21) {
        result = "You Lose!";
    } 
    else if (dealerSum > 21){
        result = "You Win!";
    }
    else if (yourSum === dealerSum) {
        result = "Tie!";
    } 
    else if (yourSum > dealerSum) {
        result = "You Win!";
    } 
    else {
        result = "You Lose!";
    }

    const gameInfo = {
        player: {
            cardCount: playerCards.length,
            sum: yourSum,
            cardValues: playerCards
        },
        dealer: {
            cardCount: dealerCards.length,
            sum: dealerSum,
            cardValues: dealerCards
        },
        chips: chipBalance,
        currentBet: currentBet,
        result: result,
        timestamp: new Date().toISOString() // 加上時間戳以便辨識每回合
    };

    // 讀取現有的遊戲歷史記錄
    let gameHistory = JSON.parse(localStorage.getItem("gameHistory")) || [];
    let sessionGameHistory = JSON.parse(sessionStorage.getItem("gameHistory")) || [];

    // 新增新回合資訊到遊戲歷史
    gameHistory.push(gameInfo);
    sessionGameHistory.push(gameInfo);

    // 儲存更新後的遊戲歷史到 localStorage 和 sessionStorage
    localStorage.setItem("gameHistory", JSON.stringify(gameHistory));
    sessionStorage.setItem("gameHistory", JSON.stringify(sessionGameHistory));

    console.log("新回合已儲存到 localStorage 和 sessionStorage:", gameInfo);
}


function clearGameHistory() {
    localStorage.removeItem("gameHistory");
    sessionStorage.removeItem("gameHistory");
}

function displayGameHistory() {
    // Retrieve game history from localStorage and sessionStorage
    const localHistory = JSON.parse(localStorage.getItem("gameHistory")) || [];
    const sessionHistory = JSON.parse(sessionStorage.getItem("gameHistory")) || [];

    // Check if localStorage and sessionStorage data are identical
    if (JSON.stringify(localHistory) !== JSON.stringify(sessionHistory)) {
        console.error("Data mismatch between localStorage and sessionStorage.");
        const historyContainer = document.getElementById("history-container");
        historyContainer.innerHTML = "<p>Data mismatch between localStorage and sessionStorage. Unable to display game history.</p>";
        return;
    }

    // Create the table element if data matches
    const table = document.createElement("table");
    // table.border = "1";
    table.classList.add("styled-table");
    table.style.width = "100%";
    table.style.marginTop = "20px";

    // Create the header row for the table
    const headerRow = table.insertRow();
    const headers = ["Round", "Player Card Count", "Player Points", "Player Cards", "Dealer Card Count", "Dealer Points", "Dealer Cards", "Remaining Chips", "Bet Amount", "Result", "Timestamp"];
    headers.forEach(headerText => {
        const headerCell = document.createElement("th");
        headerCell.innerText = headerText;
        headerRow.appendChild(headerCell);
    });

    // Add each game round to the table from localHistory (or sessionHistory, since they are identical)
    localHistory.forEach((record, index) => {
        const row = table.insertRow();
        
        row.insertCell().innerText = index + 1; // Round number
        row.insertCell().innerText = record.player.cardCount; // Player card count
        row.insertCell().innerText = record.player.sum; // Player total points
        row.insertCell().innerText = record.player.cardValues.join(", "); // Player card details

        row.insertCell().innerText = record.dealer.cardCount; // Dealer card count
        row.insertCell().innerText = record.dealer.sum; // Dealer total points
        row.insertCell().innerText = record.dealer.cardValues.join(", "); // Dealer card details

        row.insertCell().innerText = record.chips; // Remaining chips after round
        row.insertCell().innerText = record.currentBet; // Bet amount for this round
        row.insertCell().innerText = record.result;
        row.insertCell().innerText = new Date(record.timestamp).toLocaleString("en-US", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "numeric",
            minute: "numeric",
            second: "numeric",
            hour12: false
        }); // Timestamp for this round
    });

    // Clear any previous content in the history container and append the new table
    const historyContainer = document.getElementById("history-container");
    historyContainer.innerHTML = ""; // Clear previous table content
    historyContainer.appendChild(table); // Add the new table to the container

    const restartButton = document.createElement("button");
    restartButton.innerText = "Restart Game";
    restartButton.classList.add("restart-button");
    restartButton.addEventListener("click", () => {
        // 刷新頁面或執行初始化邏輯
        if (confirm("You lost! Do you want to restart the game?")) {
            // 清空遊戲數據
            localStorage.clear();
            sessionStorage.clear();
            
            // 刷新頁面
            window.location.reload();
        }
    });

    historyContainer.appendChild(restartButton);
}

function showElement(id) {
    const element = document.getElementById(id);
    if (element) {
        element.style.display = "block"; // 顯示元素
    }
}

function hideElement(id) {
    const element = document.getElementById(id);
    if (element) {
        element.style.display = "none"; // 隱藏元素
    }
}

function showCenterMessage(text) {
    const messageElement = document.getElementById("center-message");
    messageElement.innerText = text;
    messageElement.classList.remove("hidden");
    messageElement.classList.add("show");

    setTimeout(() => {
        messageElement.classList.remove("show");
        messageElement.classList.add("hide");

        setTimeout(() => {
            messageElement.classList.add("hidden");
            messageElement.classList.remove("hide");
        }, 500); 
    }, 2000); 
}

function showCenterMessage(text) {
    const messageElement = document.getElementById("center-message");
    messageElement.innerText = text;
    messageElement.classList.remove("hidden");
    messageElement.classList.add("show");

    setTimeout(() => {
        messageElement.classList.remove("show");
        messageElement.classList.add("hide");

        setTimeout(() => {
            messageElement.classList.add("hidden");
            messageElement.classList.remove("hide");
        }, 500); 
    }, 3000); 
}

function showCenterMessageAlert(text) {
    const messageElement = document.getElementById("center-message-alert");
    messageElement.innerText = text;
    messageElement.classList.remove("hidden");
    messageElement.classList.add("show");

    setTimeout(() => {
        messageElement.classList.remove("show");
        messageElement.classList.add("hide");

        setTimeout(() => {
            messageElement.classList.add("hidden");
            messageElement.classList.remove("hide");
        }, 500); 
    }, 1000); 
}

function preventReloadWithAlert() {
    window.addEventListener("beforeunload", (event) => {
        // 顯示確認提示框
        const confirmationMessage = "Are you sure you want to reload? Unsaved changes may be lost.";
        
        // 一些瀏覽器需要設置 returnValue 才能顯示提示
        event.returnValue = confirmationMessage; 
        return confirmationMessage; 
    });
}




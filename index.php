<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Tic Tac Toe</title>
<style>
    body {
        background: #222;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-family: Arial, sans-serif;
        color: white;
        margin: 0;
    }
    .container {
        text-align: center;
    }
    h1 { margin-bottom: 20px; }

    #board {
        display: grid;
        grid-template-columns: repeat(3, 120px);
        grid-gap: 10px;
        margin-bottom: 20px;
    }
    .cell {
        width: 120px;
        height: 120px;
        background: #333;
        font-size: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        border-radius: 10px;
        transition: 0.2s;
    }
    .cell:hover {
        background: #444;
    }
    #message {
        margin: 10px;
        font-size: 22px;
        height: 30px;
    }
    button {
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
        background: #09f;
        border: none;
        border-radius: 6px;
        color: white;
    }
    button:hover {
        background: #08c;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Tic Tac Toe</h1>
    <div id="board"></div>
    <div id="message"></div>
    <button onclick="resetGame()">Restart</button>
</div>

<script>
    const board = document.getElementById("board");
    const message = document.getElementById("message");
    let cells = [];
    let currentPlayer = "X";
    let gameActive = true;

    function createBoard() {
        board.innerHTML = "";
        cells = [];

        for (let i = 0; i < 9; i++) {
            const cell = document.createElement("div");
            cell.classList.add("cell");
            cell.dataset.index = i;
            cell.addEventListener("click", handleCellClick);
            board.appendChild(cell);
            cells.push(cell);
        }
    }

    function handleCellClick(e) {
        const cell = e.target;

        if (!gameActive || cell.textContent !== "") return;

        cell.textContent = currentPlayer;

        if (checkWinner()) {
            message.textContent = `${currentPlayer} wins! 🎉`;
            gameActive = false;
            return;
        }

        if (isDraw()) {
            message.textContent = "It's a draw!";
            gameActive = false;
            return;
        }

        currentPlayer = currentPlayer === "X" ? "O" : "X";
        message.textContent = `${currentPlayer}'s turn`;
    }

    function checkWinner() {
        const winPatterns = [
            [0,1,2], [3,4,5], [6,7,8],
            [0,3,6], [1,4,7], [2,5,8],
            [0,4,8], [2,4,6]
        ];

        return winPatterns.some(pattern => {
            const [a, b, c] = pattern;
            return (
                cells[a].textContent &&
                cells[a].textContent === cells[b].textContent &&
                cells[a].textContent === cells[c].textContent
            );
        });
    }

    function isDraw() {
        return cells.every(c => c.textContent !== "");
    }

    function resetGame() {
        currentPlayer = "X";
        gameActive = true;
        message.textContent = "X's turn";
        createBoard();
    }

    createBoard();
    message.textContent = "X's turn";
</script>

</body>
</html>

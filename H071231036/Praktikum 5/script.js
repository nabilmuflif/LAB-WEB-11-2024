let playerMoney = 5000;
let playerCards = [];
let dealerCards = [];
let deck = [];
let betAmount = 100;

function createDeck() {
    const suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
    const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
    deck = [];

    for (let suit of suits) {
        for (let value of values) {
            deck.push({ suit, value });
        }
    }

    deck.sort(() => Math.random() - 0.5);
}

function calculateTotal(cards) {
    let total = 0;
    let aces = 0;

    for (let card of cards) {
        if (card.value === 'J' || card.value === 'Q' || card.value === 'K') {
            total += 10;
        } else if (card.value === 'A') {
            total += 11;
            aces += 1;
        } else {
            total += parseInt(card.value);
        }
    }

    while (total > 21 && aces > 0) {
        total -= 10;
        aces -= 1;
    }

    return total;
}

function startGame() {
    betAmount = parseInt(document.getElementById('bet-amount').value);
    if (betAmount < 100 || betAmount > playerMoney) {
        alert('Taruhan tidak valid! Pastikan minimal $100 dan tidak melebihi jumlah uang yang Anda miliki.');
        return;
    }

    playerMoney -= betAmount;
    document.getElementById('player-money').textContent = playerMoney;

    createDeck();
    playerCards = [deck.pop(), deck.pop()];
    dealerCards = [deck.pop(), deck.pop()];

    document.getElementById('player-cards').innerHTML = displayCards(playerCards);
    document.getElementById('dealer-cards').innerHTML = displayCards([dealerCards[0], { suit: '', value: '?' }]);

    updateTotals();
    document.getElementById('message').textContent = '';

    checkGameOver();
}

function displayCards(cards) {
    return cards.map(card => `${card.value} of ${card.suit}`).join(', ');
}


function updateTotals() {
    const playerTotal = calculateTotal(playerCards);
    const dealerTotal = calculateTotal(dealerCards);
    
    document.getElementById('player-total').textContent = playerTotal;
    document.getElementById('dealer-total').textContent = dealerTotal > 17 ? dealerTotal : '?';
}

function hit() {
    playerCards.push(deck.pop());
    document.getElementById('player-cards').innerHTML = displayCards(playerCards);
    updateTotals();

    if (calculateTotal(playerCards) > 21) {
        endGame('Bust! Kamu kalah.');
    }
}

function stay() {
    document.getElementById('dealer-cards').innerHTML = displayCards(dealerCards);
    updateTotals();

    let dealerTotal = calculateTotal(dealerCards);
    while (dealerTotal < 17) {
        dealerCards.push(deck.pop());
        dealerTotal = calculateTotal(dealerCards);
        updateTotals();
    }

    checkWinner();
}

function checkWinner() {
    const playerTotal = calculateTotal(playerCards);
    const dealerTotal = calculateTotal(dealerCards);

    if (dealerTotal > 21) {
        endGame('Dealer busts! Kamu menang!');
        playerMoney += betAmount * 2; 
    } else if (playerTotal > dealerTotal) {
        endGame('Kamu menang!');
        playerMoney += betAmount * 2; 
    } else if (playerTotal < dealerTotal) {
        endGame('Dealer menang!');
    } else {
        endGame('Push! Seri.');
        playerMoney += betAmount;
    }

    document.getElementById('player-money').textContent = playerMoney;

    checkGameOver();
}

function endGame(message) {
    document.getElementById('message').textContent = message;
    document.getElementById('player-money').textContent = playerMoney;
}

function checkGameOver() {
    if (playerMoney <= 0) {
        document.getElementById('game-over').classList.remove('hidden');
        document.getElementById('hit-button').disabled = true;
        document.getElementById('stay-button').disabled = true;
        document.getElementById('start-game-button').disabled = true;
    }
}

function restartGame() {
    playerMoney = 5000;
    document.getElementById('player-money').textContent = playerMoney;
    document.getElementById('game-over').classList.add('hidden');
    document.getElementById('hit-button').disabled = false;
    document.getElementById('stay-button').disabled = false;
    document.getElementById('start-game-button').disabled = false;
    document.getElementById('message').textContent = '';
}

document.getElementById('start-game-button').addEventListener('click', startGame);
document.getElementById('hit-button').addEventListener('click', hit);
document.getElementById('stay-button').addEventListener('click', stay);
document.getElementById('restart-game-button').addEventListener('click', restartGame);

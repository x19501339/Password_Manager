/*javascript for random password generator */
// Get references to HTML elements
const characterAmountRange = document.getElementById('characterAmountRange')
const characterAmountNumber = document.getElementById('characterAmountNumber')
const includeUppercaseElement = document.getElementById('includeUppercase')
const includeNumbersElement = document.getElementById('includeNumbers')
const includeSymbolsElement = document.getElementById('includeSymbols')
const form = document.getElementById('passwordGeneratorForm')
const passwordDisplay = document.getElementById('passwordDisplay')

// Define arrays of character codes
const LOWERCASE_CHAR_CODES = arrayFromLowToHigh(97, 122)
const UPPERCASE_CHAR_CODES = arrayFromLowToHigh(65, 90)
const NUMBER_CHAR_CODES = arrayFromLowToHigh(48, 57)
const SYMBOL_CHAR_CODES = arrayFromLowToHigh(33, 47).concat( arrayFromLowToHigh(58, 64)).concat( arrayFromLowToHigh(91, 96)).concat( arrayFromLowToHigh(123,126))

// Listen for input events on character amount elements and sync them
characterAmountNumber.addEventListener('input', syncCharacterAmount)
characterAmountRange.addEventListener('input', syncCharacterAmount)

// Listen for form submission and generate password
form.addEventListener('submit', e => {
    e.preventDefault() // prevent default form submission behavior
    const characterAmount = characterAmountNumber.value // get selected character amount
    const includeUppercase = includeUppercaseElement.checked // get whether to include uppercase letters
    const includeNumbers = includeNumbersElement.checked// get whether to include numbers
    const includeSymbols = includeSymbolsElement.checked// get whether to include symbols
    const password = generatePassword(characterAmount, includeUppercase, includeNumbers, includeSymbols) // generate password based on selected criteria
    passwordDisplay.innerText = password // display generated password
})

// Generate password based on selected criteria
function generatePassword(characterAmount, includeUppercase, includeNumbers, includeSymbols) {
    let charCodes = LOWERCASE_CHAR_CODES // start with lowercase letters
    if(includeUppercase) charCodes = charCodes.concat(UPPERCASE_CHAR_CODES) // if include uppercase letters, add to charCodes
    if(includeNumbers) charCodes = charCodes.concat(NUMBER_CHAR_CODES) // if include numbers, add to charCodes
    if(includeSymbols) charCodes = charCodes.concat(SYMBOL_CHAR_CODES) // if include symbols, add to charCodes

    const passwordCharacters = [] // start with empty password characters array
    for (let i = 0; i < characterAmount; i++) { // loop for each character in the password
        const characterCode = charCodes[Math.floor(Math.random() * charCodes.length)]  // generate a random character code from the charCodes array
        passwordCharacters.push(String.fromCharCode(characterCode))  // add the corresponding character to the password characters array
    }
    return passwordCharacters.join('') // join the password characters array into a string and return it
}

// Generate an array of character codes between low and high (inclusive)
function arrayFromLowToHigh(low, high) {
    const array = [] // start with empty array
    for (let i = low; i <= high; i++) {
        array.push(i) // add each character code to the array
    }
    return array // return the resulting array
}

// Sync character amount elements
function syncCharacterAmount(e) {
    const value = e.target.value // get input value
    characterAmountNumber.value = value // sync input value with number element
    characterAmountRange.value = value // sync input value with range element
}


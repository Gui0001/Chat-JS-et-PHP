// 1) Création de la fonction getMessages() qui récupère les messages grace à une requete HTTP
function getMessages() {
    // On écrit notre requete
    axios.get('chat.php')
    .then(res => res.data)
    .then(data => {
        const array = data.reverse().map((message) => {
            return `
            <div class="message">
                <div class="date">${message.created_at.slice(0, 16)}</div>
                <div class="author">${message.author}</div>
                <div class="content">${message.content}</div>
            </div>`
        }).join('')

        const messages = document.querySelector('.messages')
        messages.innerHTML = array
    })
    .catch(err => console.log(err))
}

// 2) Création de la fonction sendMessage() qui envoit un message grace à une requete HTTP
function sendMessage(e) {
    // On veut empecher la soumission classique du formulaire
    e.preventDefault()

    const author = document.getElementById('author')
    const content = document.getElementById('content')

    // On veut récup les infos inserées et les ajouter à un objet de type formData
    const data = new FormData()

    data.append('author', author.value)
    data.append('content', content.value)

    // On fait notre requete HTTP afin de poster les infos (vers chat.php)
    axios.post('chat.php?action=write', data)

    // On vient vider le champ 'content' après envoit du message
    content.value = ''

    // On appelle getMessages afin d'afficher les messages
    getMessages()
}


// On vient écouter le bouton de submit et appeller la fonction sendMessage
document.querySelector('form').addEventListener('submit', sendMessage)

// On ajoute le setInterval
const interval = setInterval(getMessages, 2000)
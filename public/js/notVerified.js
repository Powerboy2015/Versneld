const sendEmailBut = document.querySelector("#resend");
const confirmBut = document.querySelector(".confirm_slide");

const verifyCard = document.querySelector('#verify');
const emailSentCard = document.querySelector('#emailSent');

const cooldown = 1000 * 60 * 1;
            //   ms    s    m  

let onCooldown = false;

async function ResendEmail() {
    
    const response = await fetch('/api/sendVerifyEmail',{
        method: "POST",
        body: "data"
    })


    if (response.ok) {
        return response.json();
    } else {
        return false;
    }
}

sendEmailBut.addEventListener('click', (e) =>{
    if(!onCooldown) {
        ResendEmail().then((succeed) =>{
            console.log(succeed);
            if (succeed) {
                verifyCard.classList.toggle('active');
                emailSentCard.classList.toggle('active');
            } else if (typeof(succeed) != 'boolean') {
                console.error(succeed);
            }
            else {
                console.error('error has occured');
            }
        })
    }
});
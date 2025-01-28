const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');

const app = express();
app.use(bodyParser.json());

// Configuração do Nodemailer
const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: 'deadx923@gmail.com', // Substitua pelo seu e-mail
        pass: 'Th7391710173'   // Substitua pela sua senha de e-mail (ou use uma senha de aplicativo)
    }
});

app.post('/send-email', (req, res) => {
    const { to, subject, body } = req.body;

    const mailOptions = {
        from: 'deadx923@gmail.com', // Substitua pelo seu e-mail
        to: to,
        subject: subject,
        html: body
    };

    transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            console.error('Erro ao enviar e-mail:', error);
            res.status(500).send('Erro ao enviar e-mail.');
        } else {
            console.log('E-mail enviado:', info.response);
            res.status(200).send('Instruções enviadas para o seu e-mail. Por favor, siga as instruções enviadas.');
        }
    });
});

app.listen(3000, () => {
    console.log('Servidor rodando na porta 3000');
});

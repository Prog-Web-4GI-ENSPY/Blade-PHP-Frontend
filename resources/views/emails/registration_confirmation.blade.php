@component('mail::message')

Bienvenue chez Shopecart, {{ $name }} !

Merci de vous être inscrit(e) sur notre plateforme. Nous sommes ravis de vous compter parmi nous.

Vous êtes maintenant prêt(e) à explorer notre vaste catalogue et à passer votre première commande.

@component('mail::button', ['url' => url('/login')])
Commencer les achats
@endcomponent

Si vous rencontrez des problèmes, n'hésitez pas à nous contacter en répondant à cet e-mail.

Merci,
L'équipe Shopecart
@endcomponent
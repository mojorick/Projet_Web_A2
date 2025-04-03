$(document).ready(function() {
    // Prévisualisation de l'image avant upload
    $('#profile-upload').change(function(e) {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#profile-preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Réinitialisation de la photo
    $('#reset-photo').click(function() {
        $('#profile-preview').attr('src', 'https://bootdey.com/img/Content/avatar/avatar1.png');
        $('#profile-upload').val('');
    });
    
    // Fermeture automatique des alertes après 3 secondes
    setTimeout(function() {
        $('.alert-auto-close').fadeOut('slow', function() {
            $(this).remove();
        });
    }, 3000);
    
    // Fermeture manuelle des alertes au clic
    $(document).on('click', '.alert-auto-close', function() {
        $(this).stop().fadeOut('fast', function() {
            $(this).remove();
        });
    });
});
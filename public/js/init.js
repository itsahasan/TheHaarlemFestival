tinymce.init({
  selector: "textarea",
  plugins:
    "advcode advlist anchor autosave autolink casechange charmap checklist codesample directionality editimage emoticons export formatpainter help image insertdatetime link linkchecker lists media mediaembed nonbreaking pagebreak permanentpen powerpaste save searchreplace table tableofcontents tinymcespellchecker visualblocks visualchars wordcount",
  toolbar:
    "undo redo print spellcheckdialog formatpainter | blocks fontfamily fontsize | bold italic underline forecolor backcolor | link image | alignleft aligncenter alignright alignjustify lineheight | checklist bullist numlist indent outdent | removeformat",
  height: "700px",
  spellchecker_language: "en",
  spellchecker_active: false,
});
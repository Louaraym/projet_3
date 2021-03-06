tinyMCE.init({
  
             selector: 'textarea.tinymce',
             language : "fr_FR",
             theme: 'modern',
             plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount  imagetools  contextmenu colorpicker textpattern help',
             toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
             image_advtab: true,
             templates: [
              { title: 'Test template 1', content: 'Test 1' },
              { title: 'Test template 2', content: 'Test 2' }
                                                               ],
              entity_encoding : "raw",

              });
const validations = {
  selectRules: [
		v => !!v || 'Seleccione una opción',
	],

  requiredRules: [
		v => !!v || 'Campo obligatorio',
	],

  nameRules: [
    v => !!v || 'Campo obligatorio',
    v => (v && v.length <= 60) || 'Debe tener menos de 60 caracteres',
  ],

  emailRules: [
    v => !!v || 'Campo obligatorio',
    v => /.+@.+\..+/.test(v) || 'Debe ser un correo electrónico válido',
  ],

  passwordRules: [
    v => !!v || 'Introduzca la contraseña',
    v => (v && v.length >= 5 && v.length <= 20) || 'Debe ser entre 5 y 20 carácteres',
  ],

}
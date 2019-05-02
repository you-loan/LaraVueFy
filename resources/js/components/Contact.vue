<template>
  <v-form v-model="valid">
    <v-container>
      <v-layout
        align-center
        justify-center
      >
        <v-flex
          xs12
          sm8
          md4
        >
          <v-card class="elevation-12">
            <v-toolbar
              dark
              color="primary"
            >
              <v-toolbar-title>Contact form</v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <v-form>
                <v-text-field
                  prepend-icon="person"
                  name="name"
                  label="Name"
                  type="text"
                  v-model="name"
                  :rules="nameRules"
                  :counter="30"
                  required
                ></v-text-field>
                <v-text-field
                  prepend-icon="mail"
                  name="email"
                  label="E-mail"
                  type="email"
                  v-model="email"
                  :rules="emailRules"
                  required
                ></v-text-field>
                <v-textarea
                  prepend-icon="message"
                  name="message"
                  label="Message"
                  v-model="message"
                  :rules="messageRules"
                ></v-textarea>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="primary">Send</v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </v-form>
</template>

<script>
  export default {
    name: 'Contact',
    data: () => ({
      valid: false,
      name: '',
      nameRules: [
        v => !!v || 'Name is required',
        v => v.length <= 30 || 'Name must be less than 30 characters'
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid'
      ],
      message: '',
      messageRules: [
        v => !!v || 'Message is required',
        v => v.length <= 250 || 'MEssage must be less than 250 characters'
      ]
    })
  }
</script>

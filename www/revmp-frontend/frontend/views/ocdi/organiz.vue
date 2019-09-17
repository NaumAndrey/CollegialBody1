<template>
<div>
     <h3>Сведения об организации</h3>
     <el-input placeholder="Полное наименование организации" v-model="fullName"></el-input>
     <el-input placeholder="Телефон" v-model="tell"></el-input>
     <el-input placeholder="Адрес электронной почты" v-model="email"></el-input>
     <el-input placeholder="Сокращенное наименование организации" v-model="minName"></el-input>
     <el-input placeholder="ИНН" v-model="inn"></el-input>
     <el-input placeholder="ОГРН" v-model="ogrn"></el-input>
     <br>
     <br>
     <br>
     <br>
     <br>
     <br>
     <h3>Сведения о руководителе организации</h3>
     <el-input placeholder="Фамилия" v-model="lustName"></el-input>
     <el-input placeholder="Имя" v-model="name"></el-input>
     <el-input placeholder="Отчество" v-model="patranamyc"></el-input>
     <el-input placeholder="Телефон" v-model="telephone"></el-input>
     <el-input placeholder="Адрес элетронной почты" v-model="Email"></el-input>
     <el-input placeholder="Должность" v-model="position"></el-input>
     <br>
     <br>
     <br>
     <br>
     <br>
     <br>
     <div id="butt">
        <el-button type="primary" @click="save">Сохранить</el-button>
        <el-button @click="cancel">Отменить</el-button>
     </div>
</div>
</template>

<script>
    export default {
        data () {
            return {

            }
        },

        methods: {
            save: function () {
                alert('Подтвердите действие')
            },

            cancel: function () {
                alert('Вы действительно хотите отменить ?')
            },
        }
    }
</script>

<style>
.el-input {
    width: 200px;
}

#butt {
    text-align: left;
}
</style>


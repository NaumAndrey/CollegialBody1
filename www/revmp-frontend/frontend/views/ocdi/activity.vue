<template>
<div>
    <el-form ref="postForm" :model="postForm" class="form-container">


    <p>Дата и время начала</p>
    <el-date-picker v-model="postForm.start_data_and_time" type="datetime" format="dd.MM.yyyy HH:mm:ss" value-format="dd.MM.yyyy HH:mm:ss" placeholder="Дата начала"/>

    <br>
    <p>Дата и время окончания</p>

        <el-date-picker v-model="postForm.end_data_and_time" type="datetime" format="dd.MM.yyyy HH:mm:ss" value-format="dd.MM.yyyy HH:mm:ss" placeholder="Дата окончания"/>

    <br>
    <br>
    <p>Место проведения</p>
    <el-select v-model="postForm.location" placeholder="Санкт-Петербург, Суворовский пр, д.1, пом. 11">
    <el-option
      v-for="item in options"
      :key="item.value"
      :label="item.label"
      :value="item.value">
    </el-option>
  </el-select>
  <p>Коллегиальный орган</p>
  <el-input placeholder="Наименование 1" v-model="postForm.name_of_authority"></el-input>
  <p>Наименование мероприятия</p>
  <el-input placeholder="Наименование мероприятия 1" v-model="postForm.event_name"></el-input>
  <p>Повестка мероприятия</p>
  <el-input placeholder="О проекте постановления Правительства  Санкт-Петербурга." v-model="postForm.event_agenda"></el-input>
  <p>Председатель</p>
  <el-input placeholder="Иванов И.И., Комитет по информатизации и связи" v-model="postForm.chairman_event"></el-input>
  <p>Секретарь</p>
  <el-input placeholder="Сидоров А.А., Комитет по информатизации и связи" v-model="postForm.event_secretary"></el-input>
  <br>
  <br>
  <div id="file">
  <p>Загрузить файл</p>
    <el-upload
        class="avatar-uploader"
        action="https://jsonplaceholder.typicode.com/posts/"
        :show-file-list="false"
        :on-success="handleAvatarSuccess"
        :before-upload="beforeAvatarUpload">
        <img v-if="imageUrl" :src="imageUrl" class="avatar">
        <i v-else class="el-icon-plus avatar-uploader-icon"></i>
    </el-upload>
  </div>

  </el-form>
  <br>
  <br>
  <el-tabs type="card" @tab-click="handleClick">
    <el-tab-pane label="Состав участников">
    <el-button type="success" @click="players">Добавить участника</el-button>
      <template>
  <el-table
    :data="tableData"
    style="width: 100%">
    <el-table-column
      label="ФИО"
      prop="fio">
    </el-table-column>
    <el-table-column
      label="Должность"
      prop="position">
    </el-table-column>
    <el-table-column
      label="Организация"
      prop="organization">
    </el-table-column>
    <el-table-column
      label="Телефон"
      prop="phone">
    </el-table-column>
    <el-table-column
      label="Адрес электронной почты"
      prop="email">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot-scope="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">Изменить</el-button>
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">Удалить</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>
    </el-tab-pane>
    <el-tab-pane label="Повестка дня">
<template>
  <el-table
    :data="tableData2"
    style="width: 100%">
    <el-table-column
      label="Наименование"
      prop="name">
    </el-table-column>
    <el-table-column
      label="Слушатели"
      prop="lisents">
    </el-table-column>
    <el-table-column
      label="Решили"
      prop="decided">
    </el-table-column>
    <el-table-column
      label="Срок"
      prop="term">
    </el-table-column>
    <el-table-column
      label="Ответственный"
      prop="responsible">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot-scope="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">Изменить</el-button>
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">Удалить</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>
</el-tab-pane>

<el-tab-pane label="Рассылка (приглашение на мероприятие)">
<template>
  <el-table
    :data="tableData3"
    style="width: 100%">
    <el-table-column
      label="Текст сообщения"
      prop="text">
    </el-table-column>
    <el-table-column
      label="Получатели"
      prop="get">
    </el-table-column>
    <el-table-column
      label="Дата получения"
      prop="date">
    </el-table-column>
    <el-table-column
      label="Переодичность"
      prop="period">
    </el-table-column>
    <el-table-column
      label="Даты и время"
      prop="dataTime">
    </el-table-column>
    <el-table-column
      label="Документы карточки"
      prop="doc">
    </el-table-column>
    <el-table-column
      label="Дополнительные документы"
      prop="addDoc">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot-scope="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">Изменить</el-button>
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">Удалить</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>
</el-tab-pane>

  <el-tab-pane label="Поручения">
  <el-button type="success" @click="orders">Добавить поручения</el-button>
    <template>
  <el-table
    :data="tableData4"
    style="width: 100%">
    <el-table-column
      label="Номер пункта"
      prop="nomer">
    </el-table-column>
    <el-table-column
      label="Дата протокола"
      prop="protokol">
    </el-table-column>
    <el-table-column
      label="Описание поручения"
      prop="discription">
    </el-table-column>
    <el-table-column
      label="Срок исполнения"
      prop="term">
    </el-table-column>
    <el-table-column
      label="Ответственный"
      prop="responsible">
    </el-table-column>
    <el-table-column
      label="Исполнения поручения"
      prop="orders">
    </el-table-column>
    <el-table-column
      label="Файлы"
      prop="file">
    </el-table-column>
    <el-table-column
      align="right">
      <template slot-scope="scope">
        <el-button
          size="mini"
          @click="handleEdit(scope.$index, scope.row)">Изменить</el-button>
        <el-button
          size="mini"
          type="danger"
          @click="handleDelete(scope.$index, scope.row)">Удалить</el-button>
      </template>
    </el-table-column>
  </el-table>
</template>
  </el-tab-pane>
  </el-tabs>
  <br>
  <br>
  <div id="butt">
        <el-button type="primary" @click="save">Сохранить</el-button>
        <el-button @click="cancel">Отменить</el-button>
  </div>
  <br>
  <br>
</div>
</template>

<script>
  import {saveEntity} from '@/api/activity';

export default {
    data() {
      return {
        pickerOptions: {
          shortcuts: [{
            text: 'Today',
            onClick(picker) {
              picker.$emit('pick', new Date());
            }
          }, {
            text: 'Yesterday',
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24);
              picker.$emit('pick', date);
            }
          }, 
          
          {
            text: 'A week ago',
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit('pick', date);
            }
          }]
        },
        value1: '',
        value2: '',
        value3: '',

        options: [{
          value: 'Option1',
          label: 'Санкт-Петербург, Суворовский пр, д.1, пом. 11'
        },

        {
          value: 'Option2',
          label: 'Option2'
        }],

        value: '',
        input: '',
        activeName: 'first',
        imageUrl: '',

        tableData:[{
          fio: 'Македонская Полина Андреевна',
          position: 'Actor',
          organization: 'Bolgrad',
          phone: '+9(812)547-02-55',
          email: 'email@e.com'
        }],

        tableData2: [{
            name: 'Введите текст',
            lisents: 'Введите текст',
            decided: 'Введите текст',
            term: '2019-02-02',
            responsible: 'me'         
        }],

        tableData3: [{
            text: 'Введите текст',
            get:  'Введите текст',
            date: 'Введите текст',
            period: '2019-02-02',
            dataTime: 'me',
            doc: '[*]',
            addDoc: '""'        
        }],

        tableData4: [{
            nomer: '1.1',
            protokol:  '1997-21-12',
            discription: 'Введите текст',
            period: '12-21-1997',
            responsible: 'me',
            orders: 'Результат исполнения поручения 1',
            file: 'Картинка'        
        }],

        postForm: {

              event_name: '',
              location: '',
              start_date_and_time: '',
              end_date_and_time: '',
              event_agenda: '',
              chairman_event: '',
              event_secretary: ''

        }

      };

    },



     methods: {
         handleClick (tab, event){
             console.log(tab,event);
         },

         handleAvatarSuccess(res,file) {
            this.imageUrl = URL.createObjectURL(file.raw);
         },

         api() {

         },
         save() {
           saveEntity(this.postForm)
                   .then((response) => {
                     //this.showLoading(false);
                     this.$notify({
                       title: 'Успешно',
                       message: 'Успешно сохранено',
                       type: 'success',
                       duration: 2000
                     });

                     this.$router.push({ name: 'servicesInformationView', params: { id: response.data.id }})
                   })

                   .catch((error) => {
                     //this.showLoading(false);
                     //Показываем ошибки если есть
                     this.showFormErrors(error.response.data.errors);

                     this.$notify({
                       title: 'Ошибка сохранения',
                       message: error.message,
                       type: 'error',
                       duration: 2000
                     })
                   });
         },

          cancel() {
           this.$router.go(-1)
          },



         beforeAvatarUpload(file) {
           const isJPG = file.type === 'image/jpeg';
           const isLt2M = file.size / 1024 / 1024 < 2;

           if(!isJPG) {
             this.$message.error('Аватар должен быть в формате JPG!');
           }

           if(!isLt2M) {
             this.$message.error('Аватар должен быть в формате Lt2M!');
           }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
           return isJPG && isLt2M;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
         },

         HandleEdit(index, row) {
           console.log(index, row);
         },

         handleDelete(index, row) {
           console.log(index, row);
         },

         players: function () {
           this.$router.push({name: 'ocdiPlayers'})
         },

         orders: function () {
           this.$router.push({name: 'ocdiOrders'})
         },
     }
  };
</script>

<style>

.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
  border-color: #409EFF;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}
/*.el-input {
    width: 400px;
}*/

#butt {
  text-align: left;
}
</style>


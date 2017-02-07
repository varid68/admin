var app = angular.module('myModule', []);
app.controller("myController", ['$scope', '$http', function($scope, $http) {

   getInfo();

   function getInfo() {
      $http.post('angular/details.php').then(function(data) {
         $scope.details = data.data;
      });
   }

   $scope.tombolInsert = true;

   $scope.now = {};
   $scope.proses = function(info) {
      $scope.now = info;
      if (info.status == 'sending') {
         $scope.tombolInsert = false;
         $scope.alert = 'ORDERAN SUDAH DIPROSES!!';
      } else {
         $scope.tombolInsert = true;
         $scope.alert = '';
         
      }
   }

   $scope.Insert = function(data) {
      $('#modal-id').modal('toggle');
      $http.post('../../source/admin/angular/Insert_angular.php', {
            "kode": data.kode,
            "pembeli": data.pembeli,
            "tanggal": data.tanggal,
            "kontak": data.kontak,
            "item": data.nama_barang,
            "kurir": data.kurir,
            "jual": data.harga_jual,
            "jumlah": data.jumlah,
            "resi": data.resi,
            "total": data.total_harga,
            "alamat2": data.alamat2,
            "kec": data.kec,
            "kab": data.kab,
            "prov": data.prov
         })
         .then(function(data) {
            getInfo();
         });

   }


   $scope.delete = function(info) {
      $http.post('../../source/admin/angular/hapus_angular.php', { "kode": info.kode })
      .then(function(data) {
         if (data.data == true) {
            getInfo();

         }
      });
   }

   $scope.tableSelection = {};

   $scope.removeSelectedRows = function() {
      //start from last index because starting from first index cause shifting
      //in the array because of array.splice()
      for (var i = $scope.details.length - 1; i >= 0; i--) {
         if ($scope.tableSelection[i]) {
            //delete row from data
            $scope.details.splice(i, 1);
            //delete rowSelection property
            delete $scope.tableSelection[i];
         }
      }
   };


   $scope.checkAll = function() {
      $scope.check = true;
   }


   $('.remove').click(function() {
      var b = [];
      $('input[type=checkbox]:checked').each(function() {
         b.push($(this).val());
      });

      $.ajax({
         url: 'ajax.php',
         type: 'POST',
         data: { data: b }
      });
   });

}]);
var oTable;
$.fn.dataTableExt.oApi.fnReloadAjax = function (oSettings, sNewSource, myParams) {
    if (oSettings.oFeatures.bServerSide) {
        if (typeof sNewSource != 'undefined' && sNewSource != null) {
            oSettings.sAjaxSource = sNewSource;
        }
        oSettings.aoServerParams = [];
        oSettings.aoServerParams.push({"sName": "user",
            "fn": function (aoData) {
                for (var index in myParams) {
                    aoData.push({"name": index, "value": myParams[index]});
                }
            }
        });
        this.fnClearTable(oSettings);
        return;
    }
};
$(function () {
$('.selectpicker').selectpicker();
    oTable = $('#getallCompletedData').dataTable({
        "iDisplayLength": 20,
        "bProcessing": true,
        "bServerSide": true,
        "bFilter": false,
        
        "sAjaxSource": baseUrl + "/report/getAllAjaxData",
        "fnCreatedRow": function (nRow, aData, iDataIndex) {
          //  $('td:eq(5)', nRow).html('<a onclick="editMissingRecords(' + aData[0] + ', \'' + aData[1] + '\')" data-rowid=' + aData[0] + ' class="edit_row btn btn-xs btn-success" onclick=""><span class="glyphicon glyphicon-edit"></span>Edit</a>');
        },
        "rowCallback": function (row, data) {

        },
        "fnInitComplete": function (oSettings, json) {

        }
    });
    $('#getallCompletedData').removeClass('display').addClass('table table-striped table-bordered');
});

$('.search').click(function () {
    var $islate = $('.islate').val();
    var $village = $('.village').val();
    var $busniessname = $('.name_of_business').val();
    var $gender = $('.gender').val();
    var $martialstatus =  $('.martial_status').val();
    var $naturebusiness = $('.nature_of_business').val();
    var $specialbusniess = $('.specialty_business_service').val();
    var $typebusniess = $('.businestypesname').val();
    var $occupation = $('.occupation').val();
    var $date_of_birth_from = $('.date_of_birth_from').val();
     var $date_of_birth_to = $('.date_of_birth_to').val();
    var $sects = $('.sects').val();
    var $homestate = $('.home_state').val();
    var $homecity = $('.home_city').val();
    var $homesuburb = $('.home_suburb').val();
    
    var $businessstate = $('.business_state').val();
    var $businesscity = $('.business_city').val();
    var $businesssuburb = $('.business_suburb').val();
       
     var myArray = {         
         "islate": $islate,
            "village": $village,
            "busniessname": $busniessname,
            "gender": $gender,
            "martial_status": $martialstatus,
            "nature_of_business": $naturebusiness,
            "specialbusniess": $specialbusniess,
            "typebusniess": $typebusniess,
            "occupation": $occupation,
            "date_of_birth_from": $date_of_birth_from,
            "date_of_birth_to": $date_of_birth_to,
            "sects": $sects,            
            "specialbusniess": $specialbusniess,            
            "typebusniess": $typebusniess,
            "homecity" : $homecity,
            "homestate" : $homestate,
            "homesuburb" : $homesuburb,
            "businesscity" : $businesscity,
            "businessstate" : $businessstate,
            "businesssuburb" : $businesssuburb,
        };
     var oTable = $("#getallCompletedData").dataTable();
        oTable.fnReloadAjax(oTable.oSettings, myArray);
});

$('.clear').click(function () {
    window.location.href = baseUrl + "/report/all"; 
});
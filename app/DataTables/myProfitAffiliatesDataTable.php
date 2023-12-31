<?php

namespace App\DataTables;

use App\DataTables\myProfitAffiliatesDataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\ProfitAffiliate;
class myProfitAffiliatesDataTable extends DataTable
{
      /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->addColumn('inviter',function(ProfitAffiliate $row){
                return $row->affiliater->affiliaters->email;
            })
            ->addColumn('invitee',function(ProfitAffiliate $row){
                return $row->affiliatee->email;
            })
            ->addColumn('value_profits',function(ProfitAffiliate $row){
                return amount_currency($row->value);
            })
            ->addColumn('created_at',function(ProfitAffiliate $row){
                return $row->created_at;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Datatables\affiliatersDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(myProfitAffiliatesDataTable $model)
    {
        # return $model->newQuery();
        $profits = auth()->user()->affiliates->profits;
        return $this->applyScopes($profits);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('affiliatersdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export')->columns(':visible'),
                        Button::make('print')->columns('visible'),
                        Button::make('reset'),
                        Button::make('reload'),
                        'colvis'
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id'),
            Column::make('inviter')->title('المسوق الالكترونى'),
            Column::make('invitee')->title('المدعو'),
            Column::make('value_profits')->title('قيمة الربح'),
            Column::make('created_at')->title('تاريخ اضافة الربح'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}

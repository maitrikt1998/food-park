<?php

namespace App\DataTables;

use App\Models\Chef;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ChefDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($query){
                $edit = "<a href='".route('admin.chefs.edit',$query->id)."' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                $delete = "<a href='".route('admin.chefs.destroy',$query->id)."' class='btn btn-danger delete-item ml-2'><i class='fas fa-trash'></i></a>";

                return $edit.$delete;
            })->addColumn('status',function($query){
                if($query->status === 1){
                    return '<span class="badge badge-primary">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })->addColumn('show_at_home',function($query){
                if($query->show_at_home === 1){
                    return '<span class="badge badge-primary">Yes</span>';
                }else{
                    return '<span class="badge badge-danger">No</span>';
                }
            })->addColumn('image',function($query){
                return "<img src='".asset($query->image)."' width='100' height='100' />";
            })
            ->rawColumns(['action','status','show_at_home', 'image'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Chef $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('chef-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('image'),
            Column::make('name'),
            Column::make('title'),
            Column::make('show_at_home'),
            Column::make('status'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Chef_' . date('YmdHis');
    }
}

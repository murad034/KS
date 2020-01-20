@include('layout.beforeSearchMaster')

<div class="social clear">
    <div class="searchbtn clear">
        {!! Form::open(array('url' => url('/pCategorySearch'), 'files' => true, 'class'=>'d-flex justify-content-between') )  !!}

        <input type="text" name="searchP"   value="@if(!empty($searchP)) {{$searchP->$searchP}} @endif" placeholder="Search keyword..."/>
        <input type="submit" name="submit" value="Search"/>
        {!! Form::close() !!}
    </div>
</div>




@include('layout.afterSearchMasterUserAdmin')







<div class="contentsection contemplete clear">
    <div class="maincontent clear">

        @if(isset($sharing[0]))
            @foreach($sharing as $share)
        <div class="samepost clear">
            <h2><a href="">{{$share->qcategoryname}}</a></h2>

            <img width="100" src="{{asset('/uploads/personalPhotos/'.$share->photo)}}"  alt="">

            <h6><a href="{{url('particularProfile').'?id='.$share->uid}}">{{$share->username}}   </a>  Asked: {{$share->updated_at}}   </h6>

            <ul id="menu">

                @if($userTable->userType==1 || Auth::id()==$share->userId)

                <li><a> .......</a>
                    <ul>
                        <li><a href="{{url('questions/edit').'?id='.$share->id}}">edit </a></li>
                        <li><a href="{{url('questions/delete').'?id='.$share->id}}">delete</a></li>

                    </ul>
                </li>
                  @endif
            </ul>

            <h1>{{$share->qtitle}}  </h1>
            <div>
                <p>
                    {{$share->qcontent}}
                </p>
            </div>
            @if($share->ufile!=null)
            <h5><a download="true" href="{{asset(\Illuminate\Support\Facades\Storage::url($share->ufile))}}">---click Image/Pdf</a></h5>
           @endif
            <?php

            $count= DB::table('answer_models')
                ->join('question_models','question_models.id','answer_models.qid')
                ->where('question_models.id',$share->id,'=')
                ->count('answer_models.id');
            //dd($count);
            //$count=0;
            ?>
            <div class="leftmore clear">
                <a href="{{url('answers').'?id='.$share->id}}">
                    <?php echo  $count?>  @if($count<2) Answer @else Answers @endif</a>
            </div>

            <div class="readmore clear">
                <a href="{{url('answers/addForm').'?id='.$share->id}}">Answer</a>
            </div>
        </div>
             @endforeach
        @endif




    </div>


</div>














@include('layout.afterMain')
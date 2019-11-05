@extends('app')

@section('content')


    
<div>
        <!--メイン-->
            <div  class="containerss">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d47574.00857717284!2d139.71828551023023!3d35.64759556085902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601889a07930e2f9%3A0x62e41ee20b961991!2z6Iqd5rWm5bel5qWt5aSn5a2mIOixiua0suOCreODo-ODs-ODkeOCuQ!5e0!3m2!1sja!2sjp!4v1572866344134!5m2!1sja!2sjp" 
                width="100%" height="550" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
    
            <div>
                <img src="{{ asset('image/ona-nikki2.jpg') }}" style="width:100%;"></img>
            </div>
            
            <div>
                <img src="{{ asset('image/ona-nikki1.jpg') }}" style="width:100%;"></img>
            </div>
            <div class="media">
                <div class="media-body card">
                    <h5 class="mt-0 mb-1">Media object</h5>
                    本日もお勤めご苦労様でした
                </div>
                <img class="ml-3" src="{{ asset('image/chara.png') }}" alt="Generic placeholder image" style="width:150px;">
            </div>
            
            
            
        </div>
        
        
</div>
        
        
<!--</div>-->
@endsection

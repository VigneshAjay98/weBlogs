
// var token = '{{ Session::token() }}';
// var urlLike = '{{ route('likePost') }}';

// $(function () {
//           $("a[class='edit']").click(function (event) {
//             event.preventDefault();
//               var postTitle = $('#postTitle').text();
//               var postBody = $('#postBody').text();
//               $('#post-Title').val(postTitle);
//               $('#post-Body').val(postBody);
//               $("#editPostModal").modal("show");
//               return false;
//           });
//       });

// $(function () {
//             $("a[class='like']").click(function (event) {
//               event.preventDefault();
//               var isLike = event.target.previousElementSibling == null;
//               console.log(isLike);
//               $.ajax({
//                 method: 'POST',
//                 url: urlLike,
//                 data: {
//                         isLike: isLike,
//                         postId: postId,
//                         _token: token
//                       }
//               });
//               .done(function() {
//                 event.target.innerText = isLike ? event.target.innerText='<i class="far fa-thumbs-up" style="font-size: 13pt; display: inline-block; margin: 0 30px 2px 0;"></i>' ? '<i class="far fa-thumbs-up" style="font-size: 13pt; display: inline-block; margin: 0 30px 2px 0; color: Green;"></i>' : '<i class="far fa-thumbs-up" style="font-size: 13pt; display: inline-block; margin: 0 30px 2px 0;"></i>' : event.target.innerText='<i class="far fa-thumbs-down" style="font-size: 13pt; display: inline-block; margin: 0 30px 0 31px;">' ? '<i class="far fa-thumbs-down" style="font-size: 13pt; display: inline-block; margin: 0 30px 0 31px; color: red;">' : '<i class="far fa-thumbs-down" style="font-size: 13pt; display: inline-block; margin: 0 30px 0 31px;">';
//                 if(isLike) {
//                   event.target.nextElementSibling.innerText = '<i class="far fa-thumbs-down" style="font-size: 13pt; display: inline-block; margin: 0 30px 0 31px;">';
//                 }
//                 else {
//                   event.previousElementSibling.innerText = '<i class="far fa-thumbs-up" style="font-size: 13pt; display: inline-block; margin: 0 30px 2px 0;"></i>';
//                 }
//               });
//             });
//         });


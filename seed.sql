INSERT INTO universities(name) values("명지대학교");
INSERT INTO universities(name) values("서울대학교");
INSERT INTO universities(name) values("한양대학교");
INSERT INTO universities(name) values("카이스트");
INSERT INTO universities(name) values("성균관대학교");
INSERT INTO majors(university_id,name) values(1, "컴퓨터공학과");
INSERT INTO majors(university_id,name) values(1, "체육학과");
INSERT INTO majors(university_id,name) values(2, "화학공학과");
INSERT INTO majors(university_id,name) values(1, "화학과");
INSERT INTO majors(university_id,name) values(2, "정보통신공학과과");
INSERT INTO majors(university_id,name) values(1, "뮤지컬전공학부");
INSERT INTO professors(major_id, university_id) values(1,1);
INSERT INTO professors(major_id, university_id) values(1,2);
INSERT INTO professors(major_id, university_id) values(1,2);
INSERT INTO professors(major_id, university_id) values(1,1);
INSERT INTO professors(major_id, university_id) values(3,1);
INSERT INTO professors(major_id, university_id) values(2,2);
INSERT INTO professors(major_id, university_id) values(1,1);
INSERT INTO professor_infos(professor_id, user_id, major_id, university_id, name, photo, content) values(1, 1, 1, 1,"권동섭", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO professor_infos(professor_id, user_id, major_id, university_id, name, photo, content) values(2, 1, 1, 2,"이강선", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO professor_infos(professor_id, user_id, major_id, university_id, name, photo, content) values(3, 1, 1, 2,"장혁수", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO professor_infos(professor_id, user_id, major_id, university_id, name, photo, content) values(4, 1, 1, 1,"조세형", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO professor_infos(professor_id, user_id, major_id, university_id, name, photo, content) values(5, 1, 3, 1,"백운필", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO professor_infos(professor_id, user_id, major_id, university_id, name, photo, content) values(6, 1, 2, 2,"박지성", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO professor_infos(professor_id, user_id, major_id, university_id, name, photo, content) values(7, 1, 1, 1,"류연승", "photo.jpg", "정말 정말 좋은 교수님");
INSERT INTO users(major_id, name, email, password) values(1, "오세도", "admin", "professor");
INSERT INTO users(major_id, name, email, password) values(1, "오세도", "1234", "1234");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(1, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점수도 잘 주시고 잘 가르쳐 주세요.");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(2, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점수도 잘 주시고 잘 가르쳐 주세요.");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(3, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점수도 잘 주시고 잘 가르쳐 주세요.");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(4, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점수도 잘 주시고 잘 가르쳐 주세요.");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(5, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점수도 잘 주시고 잘 가르쳐 주세요.");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(6, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점수도 잘 주시고 잘 가르쳐 주세요.");
INSERT INTO votes(professor_id, user_id, prepare, understanding, interest, benefit, hot, comment_text) 
  values(7, 1, 5, 5, 5, 5, 5, "정말 좋은 교수님입니다. 점수도 잘 주시고 잘 가르쳐 주세요.");


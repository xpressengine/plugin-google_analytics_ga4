
<p align="center"> 
  <img src="https://raw.githubusercontent.com/xpressengine/plugin-google_analytics/master/icon.png">
 </p>

# XE3 Google Analytics GA4 Plugin
이 어플리케이션은 Xpressengine3(이하 XE3)의 플러그인입니다.

이 플러그인은 XE3에서 Google Analytics GA4 설정 기능을 제공합니다.

[![License](http://img.shields.io/badge/license-GNU%20LGPL-brightgreen.svg)]

# Installation
### Console
```
$ php artisan plugin:install google_analytics_ga4
```

### Web install
- 관리자 > 플러그인 & 업데이트 > 플러그인 목록 내에 새 플러그인 설치 버튼 클릭
- `google_analytics_ga4` 검색 후 설치하기

### Ftp upload
- 다음의 페이지에서 다운로드
    * https://store.xpressengine.io/plugins/google_analytics_ga4
    * https://github.com/xpressengine/plugin-google_analytics_ga4/releases
- 프로젝트의 `plugins` 디렉토리 아래 `google_analytics_ga4` 디렉토리명으로 압축해제
- `google_analytics_ga4` 디렉토리 이동 후 `composer dump` 명령 실행

# Usage
관리자 > 플러그인 & 업데이트 > 플러그인 목록 > Google Analytics Ga4 > 설정에서 Google Analytics Ga4 정보를 입력해서 사용합니다.

## 항목별 획득 방법

### 측정 아이디(Measurement ID)
- [구글 analytics 사이트](https://www.google.com/analytics/web/) 이동 합니다.
- 좌측 하단 `관리` 메뉴를 클릭합니다.
- 가운데 `속성` 탭에서 `데이터 스트림`을 클릭합니다.
- 웹 데이터 스트림이 없다면 `스트림 추가`를 통해 웹 데이터 스트림을 추가해줍니다.
- `측정 ID` 항목에 표시된 문자열을 복사합니다.

## 사이트 태그 연결
- 좌측 하단 `관리` 메뉴를 클릭합니다.
- 가운데 `속성` 탭에서 `데이터 스트림`을 클릭합니다.
- 데이터 스트림을 선택합니다.
- `측정 ID` 항목에 표시된 문자열을 복사합니다.
- `연결된 사이트 태그 관리` 탭으로 이동한 뒤 `측정 ID`를 추가해줍니다. 

## License
이 플러그인은 LGPL라이선스 하에 있습니다. <https://opensource.org/licenses/LGPL-2.1>
